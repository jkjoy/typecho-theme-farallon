class NeoDB {
    constructor(config) {
        this.container = config.container;
        this.types = config.types ?? ["book", "movie", "tv", "music", "game", "podcast"];
        this.baseAPI = config.baseAPI;
        this.type = "movie";
        this.status = "complete";
        this.finished = false;
        this.paged = 1;
        this.subjects = [];
        this._create();
    }

    on(event, element, callback) {
        const nodeList = document.querySelectorAll(element);
        nodeList.forEach((item) => {
            item.addEventListener(event, callback);
        });
    }

    _handleTypeClick() {
        this.on("click", ".neodb-navItem", (t) => {
            const self = t.currentTarget;
            if (self.classList.contains("current")) return;
            this.type = self.dataset.type;
            document.querySelector(".neodb-list").innerHTML = "";
            document.querySelector(".lds-ripple").classList.remove("u-hide");
            document.querySelector(".neodb-navItem.current").classList.remove("current");
            self.classList.add("current");
            this.paged = 1;
            this.finished = false;
            this.subjects = [];
            this._fetchData();
        });
    }

    _renderTypes() {
        document.querySelector(".neodb-nav").innerHTML = this.types
            .map((item) => {
                return `<span class="neodb-navItem${
                    this.type == item ? " current" : ""
                }" data-type="${item}">${item}</span>`;
            })
            .join("");
        this._handleTypeClick();
    }

    _fetchData() {
        const params = new URLSearchParams({
            type: "complete",
            category: this.type,
            page: this.paged.toString(),
        });
    
        return fetch(this.baseAPI + "?" + params.toString())
            .then((response) => response.json())
            .then((data) => {
                if (data.length) {
                    // 过滤重复项
                    data = data.filter(item => !this.subjects.some(existing => existing.item.id === item.item.id));
                    
                    if (data.length) {
                        this.subjects = [...this.subjects, ...data];
                        this._renderListTemplate();
                    }
    
                    document.querySelector(".lds-ripple").classList.add("u-hide");
                } else {
                    this.finished = true; // 没有更多数据
                    document.querySelector(".lds-ripple").classList.add("u-hide");
                }
            });
    }

    _renderListTemplate() {
        document.querySelector(".neodb-list").innerHTML = this.subjects
            .map((item) => {
                const coverImage = item.item.cover_image_url;
                const title = item.item.title;
                const rating = item.item.rating;
                const link = item.item.id;

                return `<div class="neodb-item">
                    <img src="${coverImage}" referrerpolicy="no-referrer" class="neodb-image">
                    <div class="neodb-score">
                        ${rating ? `<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926 5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38 0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147 4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z"></path></svg>${rating}` : ""}
                    </div>
                    <div class="neodb-title">
                        <a href="${link}" target="_blank">${title}</a>
                    </div>
                    
                </div>`;
            })
            .join("");
    }

    _handleScroll() {
        let isLoading = false; // 标志位，表示是否正在加载数据
        let lastScrollTop = 0; // 上一次的滚动位置
    
        window.addEventListener("scroll", () => {
            const scrollY = window.scrollY || window.pageYOffset;
            const moreElement = document.querySelector(".block-more");
    
            // 检查滚动到底部的条件
            if (
                moreElement.offsetTop + moreElement.clientHeight <= scrollY + window.innerHeight &&
                document.querySelector(".lds-ripple").classList.contains("u-hide") &&
                !this.finished &&
                !isLoading // 确保没有正在加载数据
            ) {
                isLoading = true; // 设置标志位为 true，表示正在加载数据
                document.querySelector(".lds-ripple").classList.remove("u-hide");
                this.paged++;
                this._fetchData().finally(() => {
                    isLoading = false; // 数据加载完成后，重置标志位
                });
            }
    
            // 更新上一次的滚动位置
            lastScrollTop = scrollY;
        });
    }

    _create() {
        if (document.querySelector(".neodb-container")) {
            const container = document.querySelector(this.container);
            if (!container) return;
            container.innerHTML = `
                <nav class="neodb-nav"></nav>
                <div class="neodb-list"></div>
                <div class="block-more block-more__centered">
                    <div class="lds-ripple"></div>
                </div>
            `;
            this._renderTypes();
            this._fetchData();
            this._handleScroll();
        }
    }
}

