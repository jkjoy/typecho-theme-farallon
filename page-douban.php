<?php 
/**
 * 豆瓣页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle">数据来源于豆瓣</h2>
    </header>
    <div class="site--main">
    <div class="db--container" data-token="<?php $this->options->doubanID() ?>">
        <nav class="db--nav">
            <div class="db--navItem JiEun current" data-type="movie">Movie</div>
            <div class="db--navItem JiEun" data-type="book">Book</div>
            <div class="db--navItem JiEun" data-type="music">Music</div>
        </nav>
        <div class="db--genres">
        </div>
        <div class="db--list db--list__card">
        </div>
        <div class="block-more block-more__centered">
            <div class="lds-ripple">
            </div>
        </div>
    </div>
</div>
<script>
class APIHandler {
  constructor(token) {
    this.ver = "1.0.1";
    this.type = "movie";
    this.finished = false;
    this.paged = 1;
    this.genre_list = [];
    this.genre = [];
    this.subjects = [];
    this.baseAPI = "https://node.wpista.com/v1/outer/";
    this.token = token;
    this._create();
  }
  on(event, selector, handler) {
    const elements = document.querySelectorAll(selector);
    elements.forEach(element => {
      element.addEventListener(event, handler);
    });
  }
  _fetchGenres() {
    document.querySelector(".db--genres").innerHTML = "";
    fetch(`${this.baseAPI}genres?token=${this.token}&type=${this.type}`)
      .then(response => response.json())
      .then(data => {
        if (data.data.length) {
          this.genre_list = data.data;
          this._renderGenre();
        }
      });
  }
  _handleGenreClick() {
    this.on("click", ".db--genreItem", event => {
      const target = event.currentTarget;
      if (target.classList.contains("is-active")) {
        const index = this.genre.indexOf(target.innerText);
        target.classList.remove("is-active");
        this.genre.splice(index, 1);
        this.paged = 1;
        this.finished = false;
        this.subjects = [];
        this._fetchData();
        return;
      }
      document.querySelector(".db--list").innerHTML = "";
      document.querySelector(".lds-ripple").classList.remove("u-hide");
      target.classList.add("is-active");
      this.genre.push(target.innerText);
      this.paged = 1;
      this.finished = false;
      this.subjects = [];
      this._fetchData();
    });
  }
  _renderGenre() {
    document.querySelector(".db--genres").innerHTML = this.genre_list.map(genre => 
      `<span class="db--genreItem${this.genre.includes(genre.name) ? " is-active" : ""}">${genre.name}</span>`
    ).join("");
    this._handleGenreClick();
  }
  _fetchData() {
    fetch(`${this.baseAPI}faves?token=${this.token}&type=${this.type}&paged=${this.paged}&genre=${JSON.stringify(this.genre)}`)
      .then(response => response.json())
      .then(data => {
        if (data.data.length) {
          if (document.querySelector(".db--list").classList.contains("db--list__card")) 
                    {
                        this.subjects = [...this.subjects, ...data.data];
                        this._randerDateTemplate();
                    } else {
                        this.subjects = [...this.subjects, ...data.data];
                        this._randerListTemplate();
                    }
                    document
                        .querySelector(".lds-ripple").classList.add("u-hide");
                } else {
          this.finished = true;
          document.querySelector(".lds-ripple").classList.add("u-hide");
        }
      });
  }
  _randerDateTemplate() {
        const result = this.subjects.reduce((result, item) => {
            const date = new Date(item.create_time);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const key = `${year}-${month.toString().padStart(2, "0")}`;
            if (Object.prototype.hasOwnProperty.call(result, key)) {
                result[key].push(item);
            } else {
                result[key] = [item];
            }
            return result;
        }, {});
        let html = ``;
        for (let key in result) {
            const date = key.split("-");
            html += `<div class="db--listBydate"><div class="db--titleDate "><div class="db--titleDate__day">${date[1]}</div><div class="db--titleDate__month">${date[0]}</div></div><div class="db--dateList__card">`;
            html += result[key]
                .map(subject => {
                    return `<div class="db--item">${
                      subject.is_top250
                            ? '<span class="top250">Top 250</span>'
                            : ""
                    }<img src="${
                      subject.poster
                    }" referrerpolicy="no-referrer" class="db--image"><div class="db--score ">${
                      subject.douban_score > 0
                            ? '<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" ><path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926 5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38 0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147 4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z"></path></svg>' +
                            subject.douban_score
                            : ""
                    }${
                      subject.year > 0 ? " · " + subject.year : ""
                    }</div><div class="db--title"><a href="${
                      subject.link
                    }" target="_blank">${subject.name}</a></div></div>`;
                })
                .join("");
            html += `</div></div>`;
        }
        document.querySelector(".db--list").innerHTML = html;
    }
  _renderListTemplate() {
    document.querySelector(".db--list").innerHTML = this.subjects.map(subject => 
      `<div class="db--item">
        ${subject.is_top250 ? '<span class="top250">Top 250</span>' : ""}
        <img src="${subject.poster}" referrerpolicy="no-referrer" class="db--image">
        <div class="ipc-signpost">${subject.create_time}</div>
        <div class="db--score">${subject.douban_score > 0 ? 
          `<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926 5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38 0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147 4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z"></path>
          </svg>` + subject.douban_score : ""}
          ${subject.year > 0 ? " · " + subject.year : ""}
        </div>
        <div class="db--title"><a href="${subject.link}" target="_blank">${subject.name}</a></div>
      </div>`
    ).join("");
  }
  _handleScroll() {
    window.addEventListener("scroll", () => {
      const scrollY = window.scrollY || window.pageYOffset;
      const blockMoreOffsetTop = document.querySelector(".block-more").offsetTop;
      if (blockMoreOffsetTop - window.innerHeight < scrollY && document.querySelector(".lds-ripple").classList.contains("u-hide") && !this.finished) {
        document.querySelector(".lds-ripple").classList.remove("u-hide");
        this.paged++;
        this._fetchData();
      }
    });
  }
  _handleNavClick() {
    this.on("click", ".db--navItem", event => {
      if (event.currentTarget.classList.contains("current")) return;
      this.genre = [];
      this.type = event.currentTarget.dataset.type;
      if (this.type != "book") {
        this._fetchGenres();
        document.querySelector(".db--genres").classList.remove("u-hide");
      } else {
        document.querySelector(".db--genres").classList.add("u-hide");
      }
      document.querySelector(".db--list").innerHTML = "";
      document.querySelector(".lds-ripple").classList.remove("u-hide");
      document.querySelector(".db--navItem.current").classList.remove("current");
      event.target.classList.add("current");
      this.paged = 1;
      this.finished = false;
      this.subjects = [];
      this._fetchData();
    });
  }
  _create() {
    if (document.querySelector(".db--container")) {
      const container = document.querySelector(".db--container");
      if (container.dataset.token) {
        this.token = container.dataset.token;
      } else {
        return;
      }
      const currentNavItem = document.querySelector(".db--navItem.current");
      if (currentNavItem instanceof HTMLElement) {
        this.type = currentNavItem.dataset.type;
      }
      const list = document.querySelector(".db--list");
      if (list.dataset.type) {
        this.type = list.dataset.type;
      }
      if (this.type == "movie") {
        document.querySelector(".db--genres").classList.remove("u-hide");
      }
      this._fetchGenres();
      this._fetchData();
      this._handleScroll();
      this._handleNavClick();
    }
    if (document.querySelector(".js-db")) {
      document.querySelectorAll(".js-db").forEach(element => {
        const id = element.dataset.id;
                const type = element.dataset.type;
        const parentNode = element.parentNode;
        fetch(`${this.baseAPI}${type}/${id}?token=${this.token}`)
          .then(response => response.json())
          .then(data => {
            if (data.data) {
              const itemData = data.data;
              const div = document.createElement("div");
              div.classList.add("doulist-item");
              div.innerHTML = `
                <div class="doulist-subject">
                  <div class="doulist-post">
                    <img decoding="async" referrerpolicy="no-referrer" src="${itemData.poster}">
                  </div>
                  <div class="doulist-content">
                    <div class="doulist-title">
                      <a href="${itemData.link}" class="cute" target="_blank" rel="external nofollow">${itemData.name}</a>
                    </div>
                    <div class="rating">
                      <span class="allstardark">
                        <span class="allstarlight" style="width:55%"></span>
                      </span>
                      <span class="rating_nums"> ${itemData.douban_score} </span>
                    </div>
                    <div class="abstract">${itemData.card_subtitle}</div>
                  </div>
                </div>`;
              parentNode.replaceWith(div);
            }
          });
      });
    }
    if (document.querySelector(".db--collection")) {
      document.querySelectorAll(".db--collection").forEach(collection => {
        this._fetchCollection(collection);
      });
    }
  }
  _fetchCollection(collection) {
    const style = collection.dataset.style ? collection.dataset.style : "card";
    fetch(`${this.baseAPI}v1/movies?type=${collection.dataset.type}&paged=1&genre=&start_time=${collection.dataset.start}&end_time=${collection.dataset.end}`)
      .then(response => response.json())
      .then(data => {
        if (data.length) {
          if (style === "card") {
            collection.innerHTML += data.map(item => `
              <div class="doulist-item">
                <div class="doulist-subject">
                  <div class="db--viewTime">Marked ${item.create_time}</div>
                  <div class="doulist-post">
                    <img referrerpolicy="no-referrer" src="${item.poster}">
                  </div>
                  <div class="doulist-content">
                    <div class="doulist-title">
                      <a href="${item.link}" class="cute" target="_blank" rel="external nofollow">${item.name}</a>
                    </div>
                    <div class="rating">
                      <span class="allstardark">
                        <span class="allstarlight" style="width:75%"></span>
                      </span>
                      <span class="rating_nums">${item.douban_score}</span>
                    </div>
                    <div class="abstract">${item.remark || item.card_subtitle}</div>
                  </div>
                </div>
              </div>`).join("");
          } else {
            const groupedData = data.reduce((acc, item) => {
              if (acc[item.create_time]) {
                acc[item.create_time].push(item);
              } else {
                acc[item.create_time] = [item];
              }
              return acc;
            }, {});

            let html = "";
            for (const date in groupedData) {
              html += `<div class="db--date">${date}</div><div class="db--dateList">`;
              html += groupedData[date].map(item => `
                <div class="db--card__list">
                  <img referrerpolicy="no-referrer" src="${item.poster}">
                  <div>
                    <div class="title">
                      <a href="${item.link}" class="cute" target="_blank" rel="external nofollow">${item.name}</a>
                    </div>
                    <div class="rating">
                      <span class="allstardark">
                        <span class="allstarlight" style="width:75%"></span>
                      </span>
                      <span class="rating_nums">${item.douban_score}</span>
                    </div>
                    ${item.remark || item.card_subtitle}
                  </div>
                </div>`).join("");
              html += "</div>";
            }
            collection.innerHTML = html;
          }
        }
      });
  }
}
// 在页面加载完成后实例化APIHandler类
document.addEventListener("DOMContentLoaded", () => {
  const token = "<?php $this->options->doubanID() ?>"; // 替换为你的API令牌
  new APIHandler(token);
});
</script>
</section>
<?php $this->need('footer.php'); ?>