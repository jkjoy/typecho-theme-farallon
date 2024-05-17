(() => {
    // <stdin>
    window.addComment = function(v) {
      var I, C, h, E = v.document, b = { commentReplyClass: "comment-reply-link", commentReplyTitleId: "reply-title", cancelReplyId: "cancel-comment-reply-link", commentFormId: "commentform", temporaryFormId: "wp-temp-form-div", parentIdFieldId: "comment_parent", postIdFieldId: "comment_post_ID" }, e = v.MutationObserver || v.WebKitMutationObserver || v.MozMutationObserver, r = "querySelector" in E && "addEventListener" in v, n = !!E.documentElement.dataset;
      function t() {
        d(), e && new e(o).observe(E.body, { childList: true, subtree: true });
      }
      function d(e2) {
        if (r && (I = g(b.cancelReplyId), C = g(b.commentFormId), I)) {
          let t3 = function(e3) {
            if ((e3.metaKey || e3.ctrlKey) && 13 === e3.keyCode)
              return C.removeEventListener("keydown", t3), e3.preventDefault(), C.submit.click(), false;
          };
          var t2 = t3;
          I.addEventListener("touchstart", l), I.addEventListener("click", l);
          C && C.addEventListener("keydown", t3);
          for (var n2, d2 = function(e3) {
            var t4 = b.commentReplyClass;
            e3 && e3.childNodes || (e3 = E);
            e3 = E.getElementsByClassName ? e3.getElementsByClassName(t4) : e3.querySelectorAll("." + t4);
            return e3;
          }(e2), o2 = 0, i = d2.length; o2 < i; o2++)
            (n2 = d2[o2]).addEventListener("touchstart", a), n2.addEventListener("click", a);
        }
      }
      function l(e2) {
        var t2, n2, d2 = g(b.temporaryFormId);
        d2 && h && (g(b.parentIdFieldId).value = "0", t2 = d2.textContent, d2.parentNode.replaceChild(h, d2), this.style.display = "none", n2 = (d2 = (d2 = g(b.commentReplyTitleId)) && d2.firstChild) && d2.nextSibling, d2 && d2.nodeType === Node.TEXT_NODE && t2 && (n2 && "A" === n2.nodeName && n2.id !== b.cancelReplyId && (n2.style.display = ""), d2.textContent = t2), e2.preventDefault());
      }
      function a(e2) {
        var t2 = g(b.commentReplyTitleId), t2 = t2 && t2.firstChild.textContent, n2 = this, d2 = m(n2, "belowelement"), o2 = m(n2, "commentid"), i = m(n2, "respondelement"), r2 = m(n2, "postid"), n2 = m(n2, "replyto") || t2;
        d2 && o2 && i && r2 && false === v.addComment.moveForm(d2, o2, i, r2, n2) && e2.preventDefault();
      }
      function o(e2) {
        for (var t2 = e2.length; t2--; )
          if (e2[t2].addedNodes.length)
            return void d();
      }
      function m(e2, t2) {
        return n ? e2.dataset[t2] : e2.getAttribute("data-" + t2);
      }
      function g(e2) {
        return E.getElementById(e2);
      }
      return r && "loading" !== E.readyState ? t() : r && v.addEventListener("DOMContentLoaded", t, false), { init: d, moveForm: function(e2, t2, n2, d2, o2) {
        var i, r2, l2, a2, m2, c, s, e2 = g(e2), n2 = (h = g(n2), g(b.parentIdFieldId)), y = g(b.postIdFieldId), p = g(b.commentReplyTitleId), u = (p = p && p.firstChild) && p.nextSibling;
        if (e2 && h && n2) {
          void 0 === o2 && (o2 = p && p.textContent), a2 = h, m2 = b.temporaryFormId, c = g(m2), s = (s = g(b.commentReplyTitleId)) ? s.firstChild.textContent : "", c || ((c = E.createElement("div")).id = m2, c.style.display = "none", c.textContent = s, a2.parentNode.insertBefore(c, a2)), d2 && y && (y.value = d2), n2.value = t2, I.style.display = "", e2.parentNode.insertBefore(h, e2.nextSibling), p && p.nodeType === Node.TEXT_NODE && (u && "A" === u.nodeName && u.id !== b.cancelReplyId && (u.style.display = "none"), p.textContent = o2), I.onclick = function() {
            return false;
          };
          try {
            for (var f = 0; f < C.elements.length; f++)
              if (i = C.elements[f], r2 = false, "getComputedStyle" in v ? l2 = v.getComputedStyle(i) : E.documentElement.currentStyle && (l2 = i.currentStyle), (i.offsetWidth <= 0 && i.offsetHeight <= 0 || "hidden" === l2.visibility) && (r2 = true), "hidden" !== i.type && !i.disabled && !r2) {
                i.focus();
                break;
              }
          } catch (e3) {
          }
          return false;
        }
      } };
    }(window);
  })();
  /*! This file is auto-generated */
  ;
  (() => {
    // ns-hugo:E:\OneDrive\桌面\suxiaoxiao\bigfa\bigfa.github.io\themes\farallon\assets\ts\utils.ts
    var farallonHelper = class {
      getCookie(t) {
        if (0 < document.cookie.length) {
          var e = document.cookie.indexOf(t + "=");
          if (-1 != e) {
            e = e + t.length + 1;
            var n = document.cookie.indexOf(";", e);
            return -1 == n && (n = document.cookie.length), document.cookie.substring(e, n);
          }
        }
        return "";
      }
      setCookie(t, e, n) {
        var o = /* @__PURE__ */ new Date();
        o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
        var i = "expires=" + o.toUTCString();
        document.cookie = t + "=" + e + ";" + i + ";path=/";
      }
      showNotice(message, type = "success") {
        const html = `<div class="notice--wrapper">${message}</div>`;
        document.querySelector("body").insertAdjacentHTML("beforeend", html);
        document.querySelector(".notice--wrapper").classList.add("is-active");
        setTimeout(() => {
          document.querySelector(".notice--wrapper").remove();
        }, 3e3);
      }
    };
  
    // ns-hugo:E:\OneDrive\桌面\suxiaoxiao\bigfa\bigfa.github.io\themes\farallon\assets\ts\date.ts
    var farallonDate = class {
      selector;
      timeFormat = {
        second: "second ago",
        seconds: "seconds ago",
        minute: "minute ago",
        minutes: "minutes ago",
        hour: "hour ago",
        hours: "hours ago",
        day: "day ago",
        days: "days ago",
        week: "week ago",
        weeks: "weeks ago",
        month: "month ago",
        months: "months ago",
        year: "year ago",
        years: "years ago"
      };
      doms = [];
      constructor(config) {
        this.selector = config.selector;
        if (config.timeFormat) {
          this.timeFormat = config.timeFormat;
        }
        this.init();
        setTimeout(() => {
          this.refresh();
        }, 1e3 * 5);
      }
      init() {
        this.doms = Array.from(document.querySelectorAll(this.selector));
        this.doms.forEach((dom) => {
          dom.innerText = this.humanize_time_ago(
            dom.attributes["datetime"].value
          );
        });
      }
      humanize_time_ago(datetime) {
        const time = new Date(datetime);
        const between = Date.now() / 1e3 - Number(time.getTime() / 1e3);
        if (between < 3600) {
          return `${Math.ceil(between / 60)} ${Math.ceil(between / 60) == 1 ? this.timeFormat.second : this.timeFormat.seconds}`;
        } else if (between < 86400) {
          return `${Math.ceil(between / 3600)} ${Math.ceil(between / 3660) == 1 ? this.timeFormat.hour : this.timeFormat.hours}`;
        } else if (between < 86400 * 30) {
          return `${Math.ceil(between / 86400)} ${Math.ceil(between / 86400) == 1 ? this.timeFormat.day : this.timeFormat.days}`;
        } else if (between < 86400 * 30 * 12) {
          return `${Math.ceil(between / (86400 * 30))} ${Math.ceil(between / (86400 * 30)) == 1 ? this.timeFormat.month : this.timeFormat.months}`;
        } else {
          return time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
        }
      }
      refresh() {
        this.doms.forEach((dom) => {
          dom.innerText = this.humanize_time_ago(
            dom.attributes["datetime"].value
          );
        });
      }
    };
    var date_default = farallonDate;
  
    // ns-hugo:E:\OneDrive\桌面\suxiaoxiao\bigfa\bigfa.github.io\themes\farallon\assets\ts\action.ts
    var farallonActions = class extends farallonHelper {
      singleSelector = ".post--single";
      likeButtonSelctor = ".like-btn";
      articleSelector = ".post--item";
      viewSelector = ".article--views";
      actionDomain;
      text = "";
      likeButton = null;
      post_id;
      is_single = false;
      constructor(config) {
        super();
        this.singleSelector = config.singleSelector ?? this.singleSelector;
        this.likeButtonSelctor = config.likeButtonSelctor ?? this.likeButtonSelctor;
        this.articleSelector = config.articleSelector ?? this.articleSelector;
        this.viewSelector = config.viewSelector ?? this.viewSelector;
        this.actionDomain = config.actionDomain;
        this.text = config.text ?? this.text;
        this.is_single = document.querySelector(this.singleSelector) ? true : false;
        if (this.is_single) {
          const postSingle = document.querySelector(
            this.singleSelector
          );
          this.post_id = postSingle.dataset.id ?? "";
          this.initArticleLike();
        }
      }
      initArticleLike() {
        this.likeButton = document.querySelector(this.likeButtonSelctor);
        if (this.likeButton) {
          fetch(this.actionDomain + "post/" + this.post_id + "/like").then(
            (res) => {
              res.json().then((data) => {
                this.likeButton.querySelector(
                  ".count"
                ).innerText = data.likes;
              });
            }
          );
          this.likeButton.addEventListener("click", () => {
            this.handleLike();
          });
          if (this.getCookie("like_" + this.post_id)) {
            this.likeButton.classList.add("is-active");
          }
        }
      }
      handleLike() {
        if (this.getCookie("like_" + this.post_id)) {
          return this.showNotice("You have already liked this post");
        }
        if (this.likeButton) {
          const url = this.actionDomain + "post/" + this.post_id + "/like";
          fetch(url, {
            method: "post"
          }).then((response) => {
            return response.json();
          }).then((data) => {
            this.showNotice("Thanks for your like");
            const countElement = this.likeButton?.querySelector(
              ".count"
            );
            if (countElement) {
              countElement.innerText = data.likes;
            }
            this.setCookie("like_" + this.post_id, "1", 1);
          });
          this.likeButton?.classList.add("is-active");
        }
      }
    };
    var action_default = farallonActions;
  
    // <stdin>
    var farallonBase = class extends farallonHelper {
      is_single = false;
      post_id = 0;
      is_archive = false;
      VERSION = "0.4.1";
      like_btn;
      selctor = ".like-btn";
      // @ts-ignore
      actionDomain = window.actionDomain;
      constructor() {
        super();
        this.initCopyright();
        this.initThemeSwitch();
        this.initBack2Top();
        this.initSearch();
      }
      initSearch() {
        document.querySelector('[data-action="show-search"]').addEventListener("click", () => {
          document.querySelector(".site--header__center .inner").classList.toggle("search--active");
        });
      }
      initBack2Top() {
        if (document.querySelector(".backToTop")) {
          const backToTop = document.querySelector(
            ".backToTop"
          );
          window.addEventListener("scroll", () => {
            const t = window.scrollY || window.pageYOffset;
            t > 200 ? backToTop.classList.add("is-active") : backToTop.classList.remove("is-active");
          });
          backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
          });
        }
      }
      initCopyright() {
        const copyright = `<div class="site--footer__info">
          Theme <a href="https://fatesinger.com/101971" target="_blank">farallon</a> by bigfa / version ${this.VERSION}
      </div>`;
        document.querySelector(".site--footer__content").insertAdjacentHTML("afterend", copyright);
        document.querySelector(".icon--copryrights").addEventListener("click", () => {
          document.querySelector(".site--footer__info").classList.toggle("active");
        });
      }
      initThemeSwitch() {
        const theme = localStorage.getItem("theme") ? localStorage.getItem("theme") : "auto";
        const html = `<div class="fixed--theme">
          <span class="${theme == "dark" ? "is-active" : ""}" data-action-value="dark">
              <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                  style="color: currentcolor; width: 16px; height: 16px;">
                  <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
              </svg>
          </span>
          <span class="${theme == "light" ? "is-active" : ""}" data-action-value="light">
              <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                  style="color: currentcolor; width: 16px; height: 16px;">
                  <circle cx="12" cy="12" r="5"></circle>
                  <path d="M12 1v2"></path>
                  <path d="M12 21v2"></path>
                  <path d="M4.22 4.22l1.42 1.42"></path>
                  <path d="M18.36 18.36l1.42 1.42"></path>
                  <path d="M1 12h2"></path>
                  <path d="M21 12h2"></path>
                  <path d="M4.22 19.78l1.42-1.42"></path>
                  <path d="M18.36 5.64l1.42-1.42"></path>
              </svg>
          </span>
          <span class="${theme == "auto" ? "is-active" : ""}"  data-action-value="auto">
              <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                  style="color: currentcolor; width: 16px; height: 16px;">
                  <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                  <path d="M8 21h8"></path>
                  <path d="M12 17v4"></path>
              </svg>
          </span>
      </div>`;
        document.querySelector("body").insertAdjacentHTML("beforeend", html);
        document.querySelectorAll(".fixed--theme span").forEach((item) => {
          item.addEventListener("click", () => {
            if (item.classList.contains("is-active"))
              return;
            document.querySelectorAll(".fixed--theme span").forEach((item2) => {
              item2.classList.remove("is-active");
            });
            if (item.dataset.actionValue == "dark") {
              localStorage.setItem("theme", "dark");
              document.querySelector("body").classList.remove("auto");
              document.querySelector("body").classList.add("dark");
              item.classList.add("is-active");
            } else if (item.dataset.actionValue == "light") {
              localStorage.setItem("theme", "light");
              document.querySelector("body").classList.remove("auto");
              document.querySelector("body").classList.remove("dark");
              item.classList.add("is-active");
            } else if (item.dataset.actionValue == "auto") {
              localStorage.setItem("theme", "auto");
              document.querySelector("body").classList.remove("dark");
              document.querySelector("body").classList.add("auto");
              item.classList.add("is-active");
            }
          });
        });
      }
    };
    new action_default({
      singleSelector: ".post--single",
      articleSelector: ".post--item",
      likeButtonSelctor: ".like-btn",
      // @ts-ignore
      actionDomain: window.actionDomain
    });
    new farallonBase();
    new date_default({
      selector: ".humane--time",
      //@ts-ignore
      timeFormat: window.timeFormat
    });
  })();
  