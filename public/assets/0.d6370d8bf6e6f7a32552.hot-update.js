webpackHotUpdate(0,{

/***/ "../../../../../../scripts/frontend/scrollTransformImage/index.js":
/*!******************************************************************************!*\
  !*** E:/Work/ehabana2/assets/scripts/frontend/scrollTransformImage/index.js ***!
  \******************************************************************************/
/*! dynamic exports provided */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n/**\n* demo.js\n* http://www.codrops.com\n*\n* Licensed under the MIT license.\n* http://www.opensource.org/licenses/mit-license.php\n* \n* Copyright 2019, Codrops\n* http://www.codrops.com\n*/\n\nvar _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();\n\nfunction _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\n{\n    // helper functions\n    var MathUtils = {\n        // map number x from range [a, b] to [c, d]\n        map: function map(x, a, b, c, d) {\n            return (x - a) * (d - c) / (b - a) + c;\n        },\n        // linear interpolation\n        lerp: function lerp(a, b, n) {\n            return (1 - n) * a + n * b;\n        },\n        // Random float\n        getRandomFloat: function getRandomFloat(min, max) {\n            return (Math.random() * (max - min) + min).toFixed(2);\n        }\n    };\n\n    // body element\n    var body = document.body;\n\n    // calculate the viewport size\n    var winsize = void 0;\n    var calcWinsize = function calcWinsize() {\n        return winsize = { width: window.innerWidth, height: window.innerHeight };\n    };\n    calcWinsize();\n    // and recalculate on resize\n    window.addEventListener('resize', calcWinsize);\n\n    // scroll position\n    var docScroll = void 0;\n    // for scroll speed calculation\n    var lastScroll = void 0;\n    var scrollingSpeed = 0;\n    // scroll position update function\n    var getPageYScroll = function getPageYScroll() {\n        return docScroll = window.pageYOffset || document.documentElement.scrollTop;\n    };\n    window.addEventListener('scroll', getPageYScroll);\n\n    // Item\n\n    var Item = function () {\n        function Item(el) {\n            var _this = this;\n\n            _classCallCheck(this, Item);\n\n            // the .item element\n            this.DOM = { el: el };\n            console.log(this.DOM);\n            // the inner image\n            this.DOM.image = this.DOM.el.querySelector('img');\n            this.DOM.imageWrapper = this.DOM.image.parentNode;\n            //this.DOM.title = this.DOM.el.querySelector('.content__item-title');\n            this.renderedStyles = {\n                // here we define which property will change as we scroll the page and the item is inside the viewport\n                // in this case we will be:\n                // - scaling the inner image\n                // - translating the item's title\n                // we interpolate between the previous and current value to achieve a smooth effect\n                imageScale: {\n                    // interpolated value\n                    previous: 0,\n                    // current value\n                    current: 0,\n                    // amount to interpolate\n                    ease: 0.2,\n                    // current value setter\n                    setValue: function setValue() {\n                        var toValue = 1.5;\n                        var fromValue = 1;\n                        var val = MathUtils.map(_this.props.top - docScroll, winsize.height, -1 * _this.props.height, fromValue, toValue);\n                        return Math.max(Math.min(val, toValue), fromValue);\n                    }\n                }\n                /*\n                titleTranslationY: {\n                    previous: 0, \n                    current: 0, \n                    ease: 0.1,\n                    fromValue: Number(MathUtils.getRandomFloat(30,400)),\n                    setValue: () => {\n                        const fromValue = this.renderedStyles.titleTranslationY.fromValue;\n                        const toValue = -1*fromValue;\n                        const val = MathUtils.map(this.props.top - docScroll, winsize.height, -1 * this.props.height, fromValue, toValue);\n                        return fromValue < 0 ? Math.min(Math.max(val, fromValue), toValue) : Math.max(Math.min(val, fromValue), toValue);\n                    }\n                }\n                */\n            };\n            // gets the item's height and top (relative to the document)\n            this.getSize();\n            // set the initial values\n            this.update();\n            // use the IntersectionObserver API to check when the element is inside the viewport\n            // only then the element styles will be updated\n            this.observer = new IntersectionObserver(function (entries) {\n                entries.forEach(function (entry) {\n                    return _this.isVisible = entry.intersectionRatio > 0;\n                });\n            });\n            this.observer.observe(this.DOM.el);\n            // init/bind events\n            this.initEvents();\n        }\n\n        _createClass(Item, [{\n            key: 'update',\n            value: function update() {\n                // sets the initial value (no interpolation)\n                for (var key in this.renderedStyles) {\n                    this.renderedStyles[key].current = this.renderedStyles[key].previous = this.renderedStyles[key].setValue();\n                }\n                // apply changes/styles\n                this.layout();\n            }\n        }, {\n            key: 'getSize',\n            value: function getSize() {\n                var rect = this.DOM.el.getBoundingClientRect();\n                this.props = {\n                    // item's height\n                    height: rect.height,\n                    // offset top relative to the document\n                    top: docScroll + rect.top\n                };\n            }\n        }, {\n            key: 'initEvents',\n            value: function initEvents() {\n                var _this2 = this;\n\n                window.addEventListener('resize', function () {\n                    return _this2.resize();\n                });\n            }\n        }, {\n            key: 'resize',\n            value: function resize() {\n                // gets the item's height and top (relative to the document)\n                this.getSize();\n                // on resize reset sizes and update styles\n                this.update();\n            }\n        }, {\n            key: 'render',\n            value: function render() {\n                // update the current and interpolated values\n                for (var key in this.renderedStyles) {\n                    this.renderedStyles[key].current = this.renderedStyles[key].setValue();\n                    this.renderedStyles[key].previous = MathUtils.lerp(this.renderedStyles[key].previous, this.renderedStyles[key].current, this.renderedStyles[key].ease);\n                }\n\n                // and apply changes\n                this.layout();\n            }\n        }, {\n            key: 'layout',\n            value: function layout() {\n                // scale the image..\n                this.DOM.image.style.transform = 'scale3d(' + this.renderedStyles.imageScale.previous + ',' + this.renderedStyles.imageScale.previous + ',1)';\n                // translate the title\n                //  this.DOM.title.style.transform = `translate3d(0,${this.renderedStyles.titleTranslationY.previous}px,0)`;\n            }\n        }]);\n\n        return Item;\n    }();\n\n    // SmoothScroll\n\n\n    var SmoothScroll = function () {\n        function SmoothScroll() {\n            var _this3 = this;\n\n            _classCallCheck(this, SmoothScroll);\n\n            // the <main> element\n            this.DOM = { main: document.querySelector('body') };\n            // the scrollable element\n            // we translate this element when scrolling (y-axis)\n            this.DOM.scrollable = this.DOM.main.querySelector('main[data-scroll]');\n            // the items on the page\n            this.items = [];\n            this.DOM.content = this.DOM.main.querySelector('section');\n            [].concat(_toConsumableArray(this.DOM.content.querySelectorAll('.animated-img-container'))).forEach(function (item) {\n                return _this3.items.push(new Item(item));\n            });\n            // here we define which property will change as we scroll the page\n            // in this case we will be translating on the y-axis\n            // we interpolate between the previous and current value to achieve the smooth scrolling effect\n            this.renderedStyles = {\n                translationY: {\n                    // interpolated value\n                    previous: 0,\n                    // current value\n                    current: 0,\n                    // amount to interpolate\n                    ease: 0.1,\n                    // current value setter\n                    // in this case the value of the translation will be the same like the document scroll\n                    setValue: function setValue() {\n                        return docScroll;\n                    }\n                }\n            };\n            // set the body's height\n            this.setSize();\n            // set the initial values\n            this.update();\n            // the <main> element's style needs to be modified\n            this.style();\n            // init/bind events\n            this.initEvents();\n            // start the render loop\n            requestAnimationFrame(function () {\n                return _this3.render();\n            });\n        }\n\n        _createClass(SmoothScroll, [{\n            key: 'update',\n            value: function update() {\n                // sets the initial value (no interpolation) - translate the scroll value\n                for (var key in this.renderedStyles) {\n                    this.renderedStyles[key].current = this.renderedStyles[key].previous = this.renderedStyles[key].setValue();\n                }\n                // translate the scrollable element\n                this.layout();\n            }\n        }, {\n            key: 'layout',\n            value: function layout() {\n                this.DOM.scrollable.style.transform = 'translate3d(0,' + -1 * this.renderedStyles.translationY.previous + 'px,0)';\n            }\n        }, {\n            key: 'setSize',\n            value: function setSize() {\n                // set the heigh of the body in order to keep the scrollbar on the page\n                body.style.height = this.DOM.scrollable.scrollHeight + 'px';\n            }\n        }, {\n            key: 'style',\n            value: function style() {\n                // the <main> needs to \"stick\" to the screen and not scroll\n                // for that we set it to position fixed and overflow hidden \n                this.DOM.main.style.position = 'fixed';\n                this.DOM.main.style.width = this.DOM.main.style.height = '100%';\n                this.DOM.main.style.top = this.DOM.main.style.left = 0;\n                this.DOM.main.style.overflow = 'hidden';\n            }\n        }, {\n            key: 'initEvents',\n            value: function initEvents() {\n                var _this4 = this;\n\n                // on resize reset the body's height\n                window.addEventListener('resize', function () {\n                    return _this4.setSize();\n                });\n            }\n        }, {\n            key: 'render',\n            value: function render() {\n                var _this5 = this;\n\n                // Get scrolling speed\n                // Update lastScroll\n                scrollingSpeed = Math.abs(docScroll - lastScroll);\n                lastScroll = docScroll;\n\n                // update the current and interpolated values\n                for (var key in this.renderedStyles) {\n                    this.renderedStyles[key].current = this.renderedStyles[key].setValue();\n                    this.renderedStyles[key].previous = MathUtils.lerp(this.renderedStyles[key].previous, this.renderedStyles[key].current, this.renderedStyles[key].ease);\n                }\n                // and translate the scrollable element\n                this.layout();\n\n                // for every item\n                var _iteratorNormalCompletion = true;\n                var _didIteratorError = false;\n                var _iteratorError = undefined;\n\n                try {\n                    for (var _iterator = this.items[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {\n                        var item = _step.value;\n\n                        // if the item is inside the viewport call it's render function\n                        // this will update item's styles, based on the document scroll value and the item's position on the viewport\n                        if (item.isVisible) {\n                            if (item.insideViewport) {\n                                item.render();\n                            } else {\n                                item.insideViewport = true;\n                                item.update();\n                            }\n                        } else {\n                            item.insideViewport = false;\n                        }\n                    }\n\n                    // loop..\n                } catch (err) {\n                    _didIteratorError = true;\n                    _iteratorError = err;\n                } finally {\n                    try {\n                        if (!_iteratorNormalCompletion && _iterator.return) {\n                            _iterator.return();\n                        }\n                    } finally {\n                        if (_didIteratorError) {\n                            throw _iteratorError;\n                        }\n                    }\n                }\n\n                requestAnimationFrame(function () {\n                    return _this5.render();\n                });\n            }\n        }]);\n\n        return SmoothScroll;\n    }();\n\n    /***********************************/\n    /********** Preload stuff **********/\n\n    // Get the scroll position and update the lastScroll variable\n\n\n    getPageYScroll();\n    lastScroll = docScroll;\n    // Initialize the Smooth Scrolling\n    new SmoothScroll();\n    console.log(\"scrollTransform\");\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi4vLi4vLi4vLi4vLi4vLi4vc2NyaXB0cy9mcm9udGVuZC9zY3JvbGxUcmFuc2Zvcm1JbWFnZS9pbmRleC5qcy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9FOi9Xb3JrL2VoYWJhbmEyL2Fzc2V0cy9zY3JpcHRzL2Zyb250ZW5kL3Njcm9sbFRyYW5zZm9ybUltYWdlL2luZGV4LmpzP2E4OGIiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XG4vKipcbiogZGVtby5qc1xuKiBodHRwOi8vd3d3LmNvZHJvcHMuY29tXG4qXG4qIExpY2Vuc2VkIHVuZGVyIHRoZSBNSVQgbGljZW5zZS5cbiogaHR0cDovL3d3dy5vcGVuc291cmNlLm9yZy9saWNlbnNlcy9taXQtbGljZW5zZS5waHBcbiogXG4qIENvcHlyaWdodCAyMDE5LCBDb2Ryb3BzXG4qIGh0dHA6Ly93d3cuY29kcm9wcy5jb21cbiovXG5cbnZhciBfY3JlYXRlQ2xhc3MgPSBmdW5jdGlvbiAoKSB7IGZ1bmN0aW9uIGRlZmluZVByb3BlcnRpZXModGFyZ2V0LCBwcm9wcykgeyBmb3IgKHZhciBpID0gMDsgaSA8IHByb3BzLmxlbmd0aDsgaSsrKSB7IHZhciBkZXNjcmlwdG9yID0gcHJvcHNbaV07IGRlc2NyaXB0b3IuZW51bWVyYWJsZSA9IGRlc2NyaXB0b3IuZW51bWVyYWJsZSB8fCBmYWxzZTsgZGVzY3JpcHRvci5jb25maWd1cmFibGUgPSB0cnVlOyBpZiAoXCJ2YWx1ZVwiIGluIGRlc2NyaXB0b3IpIGRlc2NyaXB0b3Iud3JpdGFibGUgPSB0cnVlOyBPYmplY3QuZGVmaW5lUHJvcGVydHkodGFyZ2V0LCBkZXNjcmlwdG9yLmtleSwgZGVzY3JpcHRvcik7IH0gfSByZXR1cm4gZnVuY3Rpb24gKENvbnN0cnVjdG9yLCBwcm90b1Byb3BzLCBzdGF0aWNQcm9wcykgeyBpZiAocHJvdG9Qcm9wcykgZGVmaW5lUHJvcGVydGllcyhDb25zdHJ1Y3Rvci5wcm90b3R5cGUsIHByb3RvUHJvcHMpOyBpZiAoc3RhdGljUHJvcHMpIGRlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTsgcmV0dXJuIENvbnN0cnVjdG9yOyB9OyB9KCk7XG5cbmZ1bmN0aW9uIF90b0NvbnN1bWFibGVBcnJheShhcnIpIHsgaWYgKEFycmF5LmlzQXJyYXkoYXJyKSkgeyBmb3IgKHZhciBpID0gMCwgYXJyMiA9IEFycmF5KGFyci5sZW5ndGgpOyBpIDwgYXJyLmxlbmd0aDsgaSsrKSB7IGFycjJbaV0gPSBhcnJbaV07IH0gcmV0dXJuIGFycjI7IH0gZWxzZSB7IHJldHVybiBBcnJheS5mcm9tKGFycik7IH0gfVxuXG5mdW5jdGlvbiBfY2xhc3NDYWxsQ2hlY2soaW5zdGFuY2UsIENvbnN0cnVjdG9yKSB7IGlmICghKGluc3RhbmNlIGluc3RhbmNlb2YgQ29uc3RydWN0b3IpKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJDYW5ub3QgY2FsbCBhIGNsYXNzIGFzIGEgZnVuY3Rpb25cIik7IH0gfVxuXG57XG4gICAgLy8gaGVscGVyIGZ1bmN0aW9uc1xuICAgIHZhciBNYXRoVXRpbHMgPSB7XG4gICAgICAgIC8vIG1hcCBudW1iZXIgeCBmcm9tIHJhbmdlIFthLCBiXSB0byBbYywgZF1cbiAgICAgICAgbWFwOiBmdW5jdGlvbiBtYXAoeCwgYSwgYiwgYywgZCkge1xuICAgICAgICAgICAgcmV0dXJuICh4IC0gYSkgKiAoZCAtIGMpIC8gKGIgLSBhKSArIGM7XG4gICAgICAgIH0sXG4gICAgICAgIC8vIGxpbmVhciBpbnRlcnBvbGF0aW9uXG4gICAgICAgIGxlcnA6IGZ1bmN0aW9uIGxlcnAoYSwgYiwgbikge1xuICAgICAgICAgICAgcmV0dXJuICgxIC0gbikgKiBhICsgbiAqIGI7XG4gICAgICAgIH0sXG4gICAgICAgIC8vIFJhbmRvbSBmbG9hdFxuICAgICAgICBnZXRSYW5kb21GbG9hdDogZnVuY3Rpb24gZ2V0UmFuZG9tRmxvYXQobWluLCBtYXgpIHtcbiAgICAgICAgICAgIHJldHVybiAoTWF0aC5yYW5kb20oKSAqIChtYXggLSBtaW4pICsgbWluKS50b0ZpeGVkKDIpO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgIC8vIGJvZHkgZWxlbWVudFxuICAgIHZhciBib2R5ID0gZG9jdW1lbnQuYm9keTtcblxuICAgIC8vIGNhbGN1bGF0ZSB0aGUgdmlld3BvcnQgc2l6ZVxuICAgIHZhciB3aW5zaXplID0gdm9pZCAwO1xuICAgIHZhciBjYWxjV2luc2l6ZSA9IGZ1bmN0aW9uIGNhbGNXaW5zaXplKCkge1xuICAgICAgICByZXR1cm4gd2luc2l6ZSA9IHsgd2lkdGg6IHdpbmRvdy5pbm5lcldpZHRoLCBoZWlnaHQ6IHdpbmRvdy5pbm5lckhlaWdodCB9O1xuICAgIH07XG4gICAgY2FsY1dpbnNpemUoKTtcbiAgICAvLyBhbmQgcmVjYWxjdWxhdGUgb24gcmVzaXplXG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIGNhbGNXaW5zaXplKTtcblxuICAgIC8vIHNjcm9sbCBwb3NpdGlvblxuICAgIHZhciBkb2NTY3JvbGwgPSB2b2lkIDA7XG4gICAgLy8gZm9yIHNjcm9sbCBzcGVlZCBjYWxjdWxhdGlvblxuICAgIHZhciBsYXN0U2Nyb2xsID0gdm9pZCAwO1xuICAgIHZhciBzY3JvbGxpbmdTcGVlZCA9IDA7XG4gICAgLy8gc2Nyb2xsIHBvc2l0aW9uIHVwZGF0ZSBmdW5jdGlvblxuICAgIHZhciBnZXRQYWdlWVNjcm9sbCA9IGZ1bmN0aW9uIGdldFBhZ2VZU2Nyb2xsKCkge1xuICAgICAgICByZXR1cm4gZG9jU2Nyb2xsID0gd2luZG93LnBhZ2VZT2Zmc2V0IHx8IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zY3JvbGxUb3A7XG4gICAgfTtcbiAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignc2Nyb2xsJywgZ2V0UGFnZVlTY3JvbGwpO1xuXG4gICAgLy8gSXRlbVxuXG4gICAgdmFyIEl0ZW0gPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGZ1bmN0aW9uIEl0ZW0oZWwpIHtcbiAgICAgICAgICAgIHZhciBfdGhpcyA9IHRoaXM7XG5cbiAgICAgICAgICAgIF9jbGFzc0NhbGxDaGVjayh0aGlzLCBJdGVtKTtcblxuICAgICAgICAgICAgLy8gdGhlIC5pdGVtIGVsZW1lbnRcbiAgICAgICAgICAgIHRoaXMuRE9NID0geyBlbDogZWwgfTtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKHRoaXMuRE9NKTtcbiAgICAgICAgICAgIC8vIHRoZSBpbm5lciBpbWFnZVxuICAgICAgICAgICAgdGhpcy5ET00uaW1hZ2UgPSB0aGlzLkRPTS5lbC5xdWVyeVNlbGVjdG9yKCdpbWcnKTtcbiAgICAgICAgICAgIHRoaXMuRE9NLmltYWdlV3JhcHBlciA9IHRoaXMuRE9NLmltYWdlLnBhcmVudE5vZGU7XG4gICAgICAgICAgICAvL3RoaXMuRE9NLnRpdGxlID0gdGhpcy5ET00uZWwucXVlcnlTZWxlY3RvcignLmNvbnRlbnRfX2l0ZW0tdGl0bGUnKTtcbiAgICAgICAgICAgIHRoaXMucmVuZGVyZWRTdHlsZXMgPSB7XG4gICAgICAgICAgICAgICAgLy8gaGVyZSB3ZSBkZWZpbmUgd2hpY2ggcHJvcGVydHkgd2lsbCBjaGFuZ2UgYXMgd2Ugc2Nyb2xsIHRoZSBwYWdlIGFuZCB0aGUgaXRlbSBpcyBpbnNpZGUgdGhlIHZpZXdwb3J0XG4gICAgICAgICAgICAgICAgLy8gaW4gdGhpcyBjYXNlIHdlIHdpbGwgYmU6XG4gICAgICAgICAgICAgICAgLy8gLSBzY2FsaW5nIHRoZSBpbm5lciBpbWFnZVxuICAgICAgICAgICAgICAgIC8vIC0gdHJhbnNsYXRpbmcgdGhlIGl0ZW0ncyB0aXRsZVxuICAgICAgICAgICAgICAgIC8vIHdlIGludGVycG9sYXRlIGJldHdlZW4gdGhlIHByZXZpb3VzIGFuZCBjdXJyZW50IHZhbHVlIHRvIGFjaGlldmUgYSBzbW9vdGggZWZmZWN0XG4gICAgICAgICAgICAgICAgaW1hZ2VTY2FsZToge1xuICAgICAgICAgICAgICAgICAgICAvLyBpbnRlcnBvbGF0ZWQgdmFsdWVcbiAgICAgICAgICAgICAgICAgICAgcHJldmlvdXM6IDAsXG4gICAgICAgICAgICAgICAgICAgIC8vIGN1cnJlbnQgdmFsdWVcbiAgICAgICAgICAgICAgICAgICAgY3VycmVudDogMCxcbiAgICAgICAgICAgICAgICAgICAgLy8gYW1vdW50IHRvIGludGVycG9sYXRlXG4gICAgICAgICAgICAgICAgICAgIGVhc2U6IDAuMixcbiAgICAgICAgICAgICAgICAgICAgLy8gY3VycmVudCB2YWx1ZSBzZXR0ZXJcbiAgICAgICAgICAgICAgICAgICAgc2V0VmFsdWU6IGZ1bmN0aW9uIHNldFZhbHVlKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgdmFyIHRvVmFsdWUgPSAxLjU7XG4gICAgICAgICAgICAgICAgICAgICAgICB2YXIgZnJvbVZhbHVlID0gMTtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhciB2YWwgPSBNYXRoVXRpbHMubWFwKF90aGlzLnByb3BzLnRvcCAtIGRvY1Njcm9sbCwgd2luc2l6ZS5oZWlnaHQsIC0xICogX3RoaXMucHJvcHMuaGVpZ2h0LCBmcm9tVmFsdWUsIHRvVmFsdWUpO1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIE1hdGgubWF4KE1hdGgubWluKHZhbCwgdG9WYWx1ZSksIGZyb21WYWx1ZSk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgLypcbiAgICAgICAgICAgICAgICB0aXRsZVRyYW5zbGF0aW9uWToge1xuICAgICAgICAgICAgICAgICAgICBwcmV2aW91czogMCwgXG4gICAgICAgICAgICAgICAgICAgIGN1cnJlbnQ6IDAsIFxuICAgICAgICAgICAgICAgICAgICBlYXNlOiAwLjEsXG4gICAgICAgICAgICAgICAgICAgIGZyb21WYWx1ZTogTnVtYmVyKE1hdGhVdGlscy5nZXRSYW5kb21GbG9hdCgzMCw0MDApKSxcbiAgICAgICAgICAgICAgICAgICAgc2V0VmFsdWU6ICgpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbnN0IGZyb21WYWx1ZSA9IHRoaXMucmVuZGVyZWRTdHlsZXMudGl0bGVUcmFuc2xhdGlvblkuZnJvbVZhbHVlO1xuICAgICAgICAgICAgICAgICAgICAgICAgY29uc3QgdG9WYWx1ZSA9IC0xKmZyb21WYWx1ZTtcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbnN0IHZhbCA9IE1hdGhVdGlscy5tYXAodGhpcy5wcm9wcy50b3AgLSBkb2NTY3JvbGwsIHdpbnNpemUuaGVpZ2h0LCAtMSAqIHRoaXMucHJvcHMuaGVpZ2h0LCBmcm9tVmFsdWUsIHRvVmFsdWUpO1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGZyb21WYWx1ZSA8IDAgPyBNYXRoLm1pbihNYXRoLm1heCh2YWwsIGZyb21WYWx1ZSksIHRvVmFsdWUpIDogTWF0aC5tYXgoTWF0aC5taW4odmFsLCBmcm9tVmFsdWUpLCB0b1ZhbHVlKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAqL1xuICAgICAgICAgICAgfTtcbiAgICAgICAgICAgIC8vIGdldHMgdGhlIGl0ZW0ncyBoZWlnaHQgYW5kIHRvcCAocmVsYXRpdmUgdG8gdGhlIGRvY3VtZW50KVxuICAgICAgICAgICAgdGhpcy5nZXRTaXplKCk7XG4gICAgICAgICAgICAvLyBzZXQgdGhlIGluaXRpYWwgdmFsdWVzXG4gICAgICAgICAgICB0aGlzLnVwZGF0ZSgpO1xuICAgICAgICAgICAgLy8gdXNlIHRoZSBJbnRlcnNlY3Rpb25PYnNlcnZlciBBUEkgdG8gY2hlY2sgd2hlbiB0aGUgZWxlbWVudCBpcyBpbnNpZGUgdGhlIHZpZXdwb3J0XG4gICAgICAgICAgICAvLyBvbmx5IHRoZW4gdGhlIGVsZW1lbnQgc3R5bGVzIHdpbGwgYmUgdXBkYXRlZFxuICAgICAgICAgICAgdGhpcy5vYnNlcnZlciA9IG5ldyBJbnRlcnNlY3Rpb25PYnNlcnZlcihmdW5jdGlvbiAoZW50cmllcykge1xuICAgICAgICAgICAgICAgIGVudHJpZXMuZm9yRWFjaChmdW5jdGlvbiAoZW50cnkpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIF90aGlzLmlzVmlzaWJsZSA9IGVudHJ5LmludGVyc2VjdGlvblJhdGlvID4gMDtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgdGhpcy5vYnNlcnZlci5vYnNlcnZlKHRoaXMuRE9NLmVsKTtcbiAgICAgICAgICAgIC8vIGluaXQvYmluZCBldmVudHNcbiAgICAgICAgICAgIHRoaXMuaW5pdEV2ZW50cygpO1xuICAgICAgICB9XG5cbiAgICAgICAgX2NyZWF0ZUNsYXNzKEl0ZW0sIFt7XG4gICAgICAgICAgICBrZXk6ICd1cGRhdGUnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIHVwZGF0ZSgpIHtcbiAgICAgICAgICAgICAgICAvLyBzZXRzIHRoZSBpbml0aWFsIHZhbHVlIChubyBpbnRlcnBvbGF0aW9uKVxuICAgICAgICAgICAgICAgIGZvciAodmFyIGtleSBpbiB0aGlzLnJlbmRlcmVkU3R5bGVzKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMucmVuZGVyZWRTdHlsZXNba2V5XS5jdXJyZW50ID0gdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLnByZXZpb3VzID0gdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLnNldFZhbHVlKCk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIC8vIGFwcGx5IGNoYW5nZXMvc3R5bGVzXG4gICAgICAgICAgICAgICAgdGhpcy5sYXlvdXQoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSwge1xuICAgICAgICAgICAga2V5OiAnZ2V0U2l6ZScsXG4gICAgICAgICAgICB2YWx1ZTogZnVuY3Rpb24gZ2V0U2l6ZSgpIHtcbiAgICAgICAgICAgICAgICB2YXIgcmVjdCA9IHRoaXMuRE9NLmVsLmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpO1xuICAgICAgICAgICAgICAgIHRoaXMucHJvcHMgPSB7XG4gICAgICAgICAgICAgICAgICAgIC8vIGl0ZW0ncyBoZWlnaHRcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiByZWN0LmhlaWdodCxcbiAgICAgICAgICAgICAgICAgICAgLy8gb2Zmc2V0IHRvcCByZWxhdGl2ZSB0byB0aGUgZG9jdW1lbnRcbiAgICAgICAgICAgICAgICAgICAgdG9wOiBkb2NTY3JvbGwgKyByZWN0LnRvcFxuICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sIHtcbiAgICAgICAgICAgIGtleTogJ2luaXRFdmVudHMnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIGluaXRFdmVudHMoKSB7XG4gICAgICAgICAgICAgICAgdmFyIF90aGlzMiA9IHRoaXM7XG5cbiAgICAgICAgICAgICAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gX3RoaXMyLnJlc2l6ZSgpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdyZXNpemUnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIHJlc2l6ZSgpIHtcbiAgICAgICAgICAgICAgICAvLyBnZXRzIHRoZSBpdGVtJ3MgaGVpZ2h0IGFuZCB0b3AgKHJlbGF0aXZlIHRvIHRoZSBkb2N1bWVudClcbiAgICAgICAgICAgICAgICB0aGlzLmdldFNpemUoKTtcbiAgICAgICAgICAgICAgICAvLyBvbiByZXNpemUgcmVzZXQgc2l6ZXMgYW5kIHVwZGF0ZSBzdHlsZXNcbiAgICAgICAgICAgICAgICB0aGlzLnVwZGF0ZSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdyZW5kZXInLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIHJlbmRlcigpIHtcbiAgICAgICAgICAgICAgICAvLyB1cGRhdGUgdGhlIGN1cnJlbnQgYW5kIGludGVycG9sYXRlZCB2YWx1ZXNcbiAgICAgICAgICAgICAgICBmb3IgKHZhciBrZXkgaW4gdGhpcy5yZW5kZXJlZFN0eWxlcykge1xuICAgICAgICAgICAgICAgICAgICB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0uY3VycmVudCA9IHRoaXMucmVuZGVyZWRTdHlsZXNba2V5XS5zZXRWYWx1ZSgpO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0ucHJldmlvdXMgPSBNYXRoVXRpbHMubGVycCh0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0ucHJldmlvdXMsIHRoaXMucmVuZGVyZWRTdHlsZXNba2V5XS5jdXJyZW50LCB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0uZWFzZSk7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgLy8gYW5kIGFwcGx5IGNoYW5nZXNcbiAgICAgICAgICAgICAgICB0aGlzLmxheW91dCgpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdsYXlvdXQnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIGxheW91dCgpIHtcbiAgICAgICAgICAgICAgICAvLyBzY2FsZSB0aGUgaW1hZ2UuLlxuICAgICAgICAgICAgICAgIHRoaXMuRE9NLmltYWdlLnN0eWxlLnRyYW5zZm9ybSA9ICdzY2FsZTNkKCcgKyB0aGlzLnJlbmRlcmVkU3R5bGVzLmltYWdlU2NhbGUucHJldmlvdXMgKyAnLCcgKyB0aGlzLnJlbmRlcmVkU3R5bGVzLmltYWdlU2NhbGUucHJldmlvdXMgKyAnLDEpJztcbiAgICAgICAgICAgICAgICAvLyB0cmFuc2xhdGUgdGhlIHRpdGxlXG4gICAgICAgICAgICAgICAgLy8gIHRoaXMuRE9NLnRpdGxlLnN0eWxlLnRyYW5zZm9ybSA9IGB0cmFuc2xhdGUzZCgwLCR7dGhpcy5yZW5kZXJlZFN0eWxlcy50aXRsZVRyYW5zbGF0aW9uWS5wcmV2aW91c31weCwwKWA7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1dKTtcblxuICAgICAgICByZXR1cm4gSXRlbTtcbiAgICB9KCk7XG5cbiAgICAvLyBTbW9vdGhTY3JvbGxcblxuXG4gICAgdmFyIFNtb290aFNjcm9sbCA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgZnVuY3Rpb24gU21vb3RoU2Nyb2xsKCkge1xuICAgICAgICAgICAgdmFyIF90aGlzMyA9IHRoaXM7XG5cbiAgICAgICAgICAgIF9jbGFzc0NhbGxDaGVjayh0aGlzLCBTbW9vdGhTY3JvbGwpO1xuXG4gICAgICAgICAgICAvLyB0aGUgPG1haW4+IGVsZW1lbnRcbiAgICAgICAgICAgIHRoaXMuRE9NID0geyBtYWluOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5JykgfTtcbiAgICAgICAgICAgIC8vIHRoZSBzY3JvbGxhYmxlIGVsZW1lbnRcbiAgICAgICAgICAgIC8vIHdlIHRyYW5zbGF0ZSB0aGlzIGVsZW1lbnQgd2hlbiBzY3JvbGxpbmcgKHktYXhpcylcbiAgICAgICAgICAgIHRoaXMuRE9NLnNjcm9sbGFibGUgPSB0aGlzLkRPTS5tYWluLnF1ZXJ5U2VsZWN0b3IoJ21haW5bZGF0YS1zY3JvbGxdJyk7XG4gICAgICAgICAgICAvLyB0aGUgaXRlbXMgb24gdGhlIHBhZ2VcbiAgICAgICAgICAgIHRoaXMuaXRlbXMgPSBbXTtcbiAgICAgICAgICAgIHRoaXMuRE9NLmNvbnRlbnQgPSB0aGlzLkRPTS5tYWluLnF1ZXJ5U2VsZWN0b3IoJ3NlY3Rpb24nKTtcbiAgICAgICAgICAgIFtdLmNvbmNhdChfdG9Db25zdW1hYmxlQXJyYXkodGhpcy5ET00uY29udGVudC5xdWVyeVNlbGVjdG9yQWxsKCcuYW5pbWF0ZWQtaW1nLWNvbnRhaW5lcicpKSkuZm9yRWFjaChmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBfdGhpczMuaXRlbXMucHVzaChuZXcgSXRlbShpdGVtKSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIC8vIGhlcmUgd2UgZGVmaW5lIHdoaWNoIHByb3BlcnR5IHdpbGwgY2hhbmdlIGFzIHdlIHNjcm9sbCB0aGUgcGFnZVxuICAgICAgICAgICAgLy8gaW4gdGhpcyBjYXNlIHdlIHdpbGwgYmUgdHJhbnNsYXRpbmcgb24gdGhlIHktYXhpc1xuICAgICAgICAgICAgLy8gd2UgaW50ZXJwb2xhdGUgYmV0d2VlbiB0aGUgcHJldmlvdXMgYW5kIGN1cnJlbnQgdmFsdWUgdG8gYWNoaWV2ZSB0aGUgc21vb3RoIHNjcm9sbGluZyBlZmZlY3RcbiAgICAgICAgICAgIHRoaXMucmVuZGVyZWRTdHlsZXMgPSB7XG4gICAgICAgICAgICAgICAgdHJhbnNsYXRpb25ZOiB7XG4gICAgICAgICAgICAgICAgICAgIC8vIGludGVycG9sYXRlZCB2YWx1ZVxuICAgICAgICAgICAgICAgICAgICBwcmV2aW91czogMCxcbiAgICAgICAgICAgICAgICAgICAgLy8gY3VycmVudCB2YWx1ZVxuICAgICAgICAgICAgICAgICAgICBjdXJyZW50OiAwLFxuICAgICAgICAgICAgICAgICAgICAvLyBhbW91bnQgdG8gaW50ZXJwb2xhdGVcbiAgICAgICAgICAgICAgICAgICAgZWFzZTogMC4xLFxuICAgICAgICAgICAgICAgICAgICAvLyBjdXJyZW50IHZhbHVlIHNldHRlclxuICAgICAgICAgICAgICAgICAgICAvLyBpbiB0aGlzIGNhc2UgdGhlIHZhbHVlIG9mIHRoZSB0cmFuc2xhdGlvbiB3aWxsIGJlIHRoZSBzYW1lIGxpa2UgdGhlIGRvY3VtZW50IHNjcm9sbFxuICAgICAgICAgICAgICAgICAgICBzZXRWYWx1ZTogZnVuY3Rpb24gc2V0VmFsdWUoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZG9jU2Nyb2xsO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfTtcbiAgICAgICAgICAgIC8vIHNldCB0aGUgYm9keSdzIGhlaWdodFxuICAgICAgICAgICAgdGhpcy5zZXRTaXplKCk7XG4gICAgICAgICAgICAvLyBzZXQgdGhlIGluaXRpYWwgdmFsdWVzXG4gICAgICAgICAgICB0aGlzLnVwZGF0ZSgpO1xuICAgICAgICAgICAgLy8gdGhlIDxtYWluPiBlbGVtZW50J3Mgc3R5bGUgbmVlZHMgdG8gYmUgbW9kaWZpZWRcbiAgICAgICAgICAgIHRoaXMuc3R5bGUoKTtcbiAgICAgICAgICAgIC8vIGluaXQvYmluZCBldmVudHNcbiAgICAgICAgICAgIHRoaXMuaW5pdEV2ZW50cygpO1xuICAgICAgICAgICAgLy8gc3RhcnQgdGhlIHJlbmRlciBsb29wXG4gICAgICAgICAgICByZXF1ZXN0QW5pbWF0aW9uRnJhbWUoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHJldHVybiBfdGhpczMucmVuZGVyKCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuXG4gICAgICAgIF9jcmVhdGVDbGFzcyhTbW9vdGhTY3JvbGwsIFt7XG4gICAgICAgICAgICBrZXk6ICd1cGRhdGUnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIHVwZGF0ZSgpIHtcbiAgICAgICAgICAgICAgICAvLyBzZXRzIHRoZSBpbml0aWFsIHZhbHVlIChubyBpbnRlcnBvbGF0aW9uKSAtIHRyYW5zbGF0ZSB0aGUgc2Nyb2xsIHZhbHVlXG4gICAgICAgICAgICAgICAgZm9yICh2YXIga2V5IGluIHRoaXMucmVuZGVyZWRTdHlsZXMpIHtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLmN1cnJlbnQgPSB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0ucHJldmlvdXMgPSB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0uc2V0VmFsdWUoKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgLy8gdHJhbnNsYXRlIHRoZSBzY3JvbGxhYmxlIGVsZW1lbnRcbiAgICAgICAgICAgICAgICB0aGlzLmxheW91dCgpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdsYXlvdXQnLFxuICAgICAgICAgICAgdmFsdWU6IGZ1bmN0aW9uIGxheW91dCgpIHtcbiAgICAgICAgICAgICAgICB0aGlzLkRPTS5zY3JvbGxhYmxlLnN0eWxlLnRyYW5zZm9ybSA9ICd0cmFuc2xhdGUzZCgwLCcgKyAtMSAqIHRoaXMucmVuZGVyZWRTdHlsZXMudHJhbnNsYXRpb25ZLnByZXZpb3VzICsgJ3B4LDApJztcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSwge1xuICAgICAgICAgICAga2V5OiAnc2V0U2l6ZScsXG4gICAgICAgICAgICB2YWx1ZTogZnVuY3Rpb24gc2V0U2l6ZSgpIHtcbiAgICAgICAgICAgICAgICAvLyBzZXQgdGhlIGhlaWdoIG9mIHRoZSBib2R5IGluIG9yZGVyIHRvIGtlZXAgdGhlIHNjcm9sbGJhciBvbiB0aGUgcGFnZVxuICAgICAgICAgICAgICAgIGJvZHkuc3R5bGUuaGVpZ2h0ID0gdGhpcy5ET00uc2Nyb2xsYWJsZS5zY3JvbGxIZWlnaHQgKyAncHgnO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdzdHlsZScsXG4gICAgICAgICAgICB2YWx1ZTogZnVuY3Rpb24gc3R5bGUoKSB7XG4gICAgICAgICAgICAgICAgLy8gdGhlIDxtYWluPiBuZWVkcyB0byBcInN0aWNrXCIgdG8gdGhlIHNjcmVlbiBhbmQgbm90IHNjcm9sbFxuICAgICAgICAgICAgICAgIC8vIGZvciB0aGF0IHdlIHNldCBpdCB0byBwb3NpdGlvbiBmaXhlZCBhbmQgb3ZlcmZsb3cgaGlkZGVuIFxuICAgICAgICAgICAgICAgIHRoaXMuRE9NLm1haW4uc3R5bGUucG9zaXRpb24gPSAnZml4ZWQnO1xuICAgICAgICAgICAgICAgIHRoaXMuRE9NLm1haW4uc3R5bGUud2lkdGggPSB0aGlzLkRPTS5tYWluLnN0eWxlLmhlaWdodCA9ICcxMDAlJztcbiAgICAgICAgICAgICAgICB0aGlzLkRPTS5tYWluLnN0eWxlLnRvcCA9IHRoaXMuRE9NLm1haW4uc3R5bGUubGVmdCA9IDA7XG4gICAgICAgICAgICAgICAgdGhpcy5ET00ubWFpbi5zdHlsZS5vdmVyZmxvdyA9ICdoaWRkZW4nO1xuICAgICAgICAgICAgfVxuICAgICAgICB9LCB7XG4gICAgICAgICAgICBrZXk6ICdpbml0RXZlbnRzJyxcbiAgICAgICAgICAgIHZhbHVlOiBmdW5jdGlvbiBpbml0RXZlbnRzKCkge1xuICAgICAgICAgICAgICAgIHZhciBfdGhpczQgPSB0aGlzO1xuXG4gICAgICAgICAgICAgICAgLy8gb24gcmVzaXplIHJlc2V0IHRoZSBib2R5J3MgaGVpZ2h0XG4gICAgICAgICAgICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIF90aGlzNC5zZXRTaXplKCk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sIHtcbiAgICAgICAgICAgIGtleTogJ3JlbmRlcicsXG4gICAgICAgICAgICB2YWx1ZTogZnVuY3Rpb24gcmVuZGVyKCkge1xuICAgICAgICAgICAgICAgIHZhciBfdGhpczUgPSB0aGlzO1xuXG4gICAgICAgICAgICAgICAgLy8gR2V0IHNjcm9sbGluZyBzcGVlZFxuICAgICAgICAgICAgICAgIC8vIFVwZGF0ZSBsYXN0U2Nyb2xsXG4gICAgICAgICAgICAgICAgc2Nyb2xsaW5nU3BlZWQgPSBNYXRoLmFicyhkb2NTY3JvbGwgLSBsYXN0U2Nyb2xsKTtcbiAgICAgICAgICAgICAgICBsYXN0U2Nyb2xsID0gZG9jU2Nyb2xsO1xuXG4gICAgICAgICAgICAgICAgLy8gdXBkYXRlIHRoZSBjdXJyZW50IGFuZCBpbnRlcnBvbGF0ZWQgdmFsdWVzXG4gICAgICAgICAgICAgICAgZm9yICh2YXIga2V5IGluIHRoaXMucmVuZGVyZWRTdHlsZXMpIHtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLmN1cnJlbnQgPSB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0uc2V0VmFsdWUoKTtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLnByZXZpb3VzID0gTWF0aFV0aWxzLmxlcnAodGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLnByZXZpb3VzLCB0aGlzLnJlbmRlcmVkU3R5bGVzW2tleV0uY3VycmVudCwgdGhpcy5yZW5kZXJlZFN0eWxlc1trZXldLmVhc2UpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAvLyBhbmQgdHJhbnNsYXRlIHRoZSBzY3JvbGxhYmxlIGVsZW1lbnRcbiAgICAgICAgICAgICAgICB0aGlzLmxheW91dCgpO1xuXG4gICAgICAgICAgICAgICAgLy8gZm9yIGV2ZXJ5IGl0ZW1cbiAgICAgICAgICAgICAgICB2YXIgX2l0ZXJhdG9yTm9ybWFsQ29tcGxldGlvbiA9IHRydWU7XG4gICAgICAgICAgICAgICAgdmFyIF9kaWRJdGVyYXRvckVycm9yID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgdmFyIF9pdGVyYXRvckVycm9yID0gdW5kZWZpbmVkO1xuXG4gICAgICAgICAgICAgICAgdHJ5IHtcbiAgICAgICAgICAgICAgICAgICAgZm9yICh2YXIgX2l0ZXJhdG9yID0gdGhpcy5pdGVtc1tTeW1ib2wuaXRlcmF0b3JdKCksIF9zdGVwOyAhKF9pdGVyYXRvck5vcm1hbENvbXBsZXRpb24gPSAoX3N0ZXAgPSBfaXRlcmF0b3IubmV4dCgpKS5kb25lKTsgX2l0ZXJhdG9yTm9ybWFsQ29tcGxldGlvbiA9IHRydWUpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhciBpdGVtID0gX3N0ZXAudmFsdWU7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgIC8vIGlmIHRoZSBpdGVtIGlzIGluc2lkZSB0aGUgdmlld3BvcnQgY2FsbCBpdCdzIHJlbmRlciBmdW5jdGlvblxuICAgICAgICAgICAgICAgICAgICAgICAgLy8gdGhpcyB3aWxsIHVwZGF0ZSBpdGVtJ3Mgc3R5bGVzLCBiYXNlZCBvbiB0aGUgZG9jdW1lbnQgc2Nyb2xsIHZhbHVlIGFuZCB0aGUgaXRlbSdzIHBvc2l0aW9uIG9uIHRoZSB2aWV3cG9ydFxuICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGl0ZW0uaXNWaXNpYmxlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGl0ZW0uaW5zaWRlVmlld3BvcnQpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaXRlbS5yZW5kZXIoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpdGVtLmluc2lkZVZpZXdwb3J0ID0gdHJ1ZTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaXRlbS51cGRhdGUoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW0uaW5zaWRlVmlld3BvcnQgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgIC8vIGxvb3AuLlxuICAgICAgICAgICAgICAgIH0gY2F0Y2ggKGVycikge1xuICAgICAgICAgICAgICAgICAgICBfZGlkSXRlcmF0b3JFcnJvciA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgIF9pdGVyYXRvckVycm9yID0gZXJyO1xuICAgICAgICAgICAgICAgIH0gZmluYWxseSB7XG4gICAgICAgICAgICAgICAgICAgIHRyeSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAoIV9pdGVyYXRvck5vcm1hbENvbXBsZXRpb24gJiYgX2l0ZXJhdG9yLnJldHVybikge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIF9pdGVyYXRvci5yZXR1cm4oKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgfSBmaW5hbGx5IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChfZGlkSXRlcmF0b3JFcnJvcikge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRocm93IF9pdGVyYXRvckVycm9yO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgcmVxdWVzdEFuaW1hdGlvbkZyYW1lKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIF90aGlzNS5yZW5kZXIoKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfV0pO1xuXG4gICAgICAgIHJldHVybiBTbW9vdGhTY3JvbGw7XG4gICAgfSgpO1xuXG4gICAgLyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqL1xuICAgIC8qKioqKioqKioqIFByZWxvYWQgc3R1ZmYgKioqKioqKioqKi9cblxuICAgIC8vIEdldCB0aGUgc2Nyb2xsIHBvc2l0aW9uIGFuZCB1cGRhdGUgdGhlIGxhc3RTY3JvbGwgdmFyaWFibGVcblxuXG4gICAgZ2V0UGFnZVlTY3JvbGwoKTtcbiAgICBsYXN0U2Nyb2xsID0gZG9jU2Nyb2xsO1xuICAgIC8vIEluaXRpYWxpemUgdGhlIFNtb290aCBTY3JvbGxpbmdcbiAgICBuZXcgU21vb3RoU2Nyb2xsKCk7XG4gICAgY29uc29sZS5sb2coXCJzY3JvbGxUcmFuc2Zvcm1cIik7XG59XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gRTovV29yay9laGFiYW5hMi9hc3NldHMvc2NyaXB0cy9mcm9udGVuZC9zY3JvbGxUcmFuc2Zvcm1JbWFnZS9pbmRleC5qc1xuLy8gbW9kdWxlIGlkID0gLi4vLi4vLi4vLi4vLi4vLi4vc2NyaXB0cy9mcm9udGVuZC9zY3JvbGxUcmFuc2Zvcm1JbWFnZS9pbmRleC5qc1xuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///../../../../../../scripts/frontend/scrollTransformImage/index.js\n");

/***/ })

})