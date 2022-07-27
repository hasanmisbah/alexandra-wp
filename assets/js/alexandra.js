/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/resource/js/alexandra.js":
/*!**************************************!*\
  !*** ./src/resource/js/alexandra.js ***!
  \**************************************/
/***/ (() => {

eval("document.addEventListener('DOMContentLoaded', function () {\n  var navigationElement = document.querySelectorAll('.admin-navigation li');\n  var tabElement = document.querySelectorAll('.tab-pane');\n  navigationElement.forEach(function (element) {\n    element.addEventListener('click', function (e) {\n      e.preventDefault();\n      switchTab(element);\n    });\n  });\n});\n\nvar removeActive = function removeActive() {\n  var navigationElement = document.querySelectorAll('.admin-navigation li');\n  var tabElement = document.querySelectorAll('.tab-pane');\n  navigationElement.forEach(function (element) {\n    return element.classList.remove('active');\n  });\n  tabElement.forEach(function (element) {\n    return element.classList.remove('active');\n  });\n};\n\nvar switchTab = function switchTab(element) {\n  removeActive();\n  element.classList.add('active');\n  var tabId = element.childNodes[0].getAttribute('href');\n  var tab = document.querySelector(\"\".concat(tabId));\n  tab.classList.add('active');\n};\n\nconsole.log('alexandra.js loaded');//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJuYXZpZ2F0aW9uRWxlbWVudCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJ0YWJFbGVtZW50IiwiZm9yRWFjaCIsImVsZW1lbnQiLCJlIiwicHJldmVudERlZmF1bHQiLCJzd2l0Y2hUYWIiLCJyZW1vdmVBY3RpdmUiLCJjbGFzc0xpc3QiLCJyZW1vdmUiLCJhZGQiLCJ0YWJJZCIsImNoaWxkTm9kZXMiLCJnZXRBdHRyaWJ1dGUiLCJ0YWIiLCJxdWVyeVNlbGVjdG9yIiwiY29uc29sZSIsImxvZyJdLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9hbGV4YW5kcmEvLi9zcmMvcmVzb3VyY2UvanMvYWxleGFuZHJhLmpzPzAyM2MiXSwic291cmNlc0NvbnRlbnQiOlsiXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZnVuY3Rpb24gKCkge1xuXG4gICAgY29uc3QgbmF2aWdhdGlvbkVsZW1lbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuYWRtaW4tbmF2aWdhdGlvbiBsaScpO1xuICAgIGNvbnN0IHRhYkVsZW1lbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcudGFiLXBhbmUnKTtcblxuICAgIG5hdmlnYXRpb25FbGVtZW50LmZvckVhY2goZWxlbWVudCA9PiB7XG4gICAgICAgIGVsZW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZSkgPT57XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICBzd2l0Y2hUYWIoZWxlbWVudClcbiAgICAgICAgfSk7XG4gICAgfSlcbn0pO1xuXG5cbmNvbnN0IHJlbW92ZUFjdGl2ZSA9ICgpID0+IHtcblxuICAgIGNvbnN0IG5hdmlnYXRpb25FbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmFkbWluLW5hdmlnYXRpb24gbGknKTtcbiAgICBjb25zdCB0YWJFbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnRhYi1wYW5lJyk7XG5cbiAgICBuYXZpZ2F0aW9uRWxlbWVudC5mb3JFYWNoKGVsZW1lbnQgPT4gZWxlbWVudC5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKSk7XG4gICAgdGFiRWxlbWVudC5mb3JFYWNoKGVsZW1lbnQgPT4gZWxlbWVudC5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKSk7XG59XG5cbmNvbnN0IHN3aXRjaFRhYiA9IChlbGVtZW50KSA9PiB7XG4gICAgcmVtb3ZlQWN0aXZlKCk7XG4gICAgZWxlbWVudC5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKVxuICAgIGNvbnN0IHRhYklkID0gZWxlbWVudC5jaGlsZE5vZGVzWzBdLmdldEF0dHJpYnV0ZSgnaHJlZicpO1xuICAgIGNvbnN0IHRhYiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoYCR7dGFiSWR9YClcbiAgICB0YWIuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG59XG5cbmNvbnNvbGUubG9nKCdhbGV4YW5kcmEuanMgbG9hZGVkJyk7XG4iXSwibWFwcGluZ3MiOiJBQUNBQSxRQUFRLENBQUNDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFZO0VBRXRELElBQU1DLGlCQUFpQixHQUFHRixRQUFRLENBQUNHLGdCQUFULENBQTBCLHNCQUExQixDQUExQjtFQUNBLElBQU1DLFVBQVUsR0FBR0osUUFBUSxDQUFDRyxnQkFBVCxDQUEwQixXQUExQixDQUFuQjtFQUVBRCxpQkFBaUIsQ0FBQ0csT0FBbEIsQ0FBMEIsVUFBQUMsT0FBTyxFQUFJO0lBQ2pDQSxPQUFPLENBQUNMLGdCQUFSLENBQXlCLE9BQXpCLEVBQWtDLFVBQUNNLENBQUQsRUFBTTtNQUNwQ0EsQ0FBQyxDQUFDQyxjQUFGO01BQ0FDLFNBQVMsQ0FBQ0gsT0FBRCxDQUFUO0lBQ0gsQ0FIRDtFQUlILENBTEQ7QUFNSCxDQVhEOztBQWNBLElBQU1JLFlBQVksR0FBRyxTQUFmQSxZQUFlLEdBQU07RUFFdkIsSUFBTVIsaUJBQWlCLEdBQUdGLFFBQVEsQ0FBQ0csZ0JBQVQsQ0FBMEIsc0JBQTFCLENBQTFCO0VBQ0EsSUFBTUMsVUFBVSxHQUFHSixRQUFRLENBQUNHLGdCQUFULENBQTBCLFdBQTFCLENBQW5CO0VBRUFELGlCQUFpQixDQUFDRyxPQUFsQixDQUEwQixVQUFBQyxPQUFPO0lBQUEsT0FBSUEsT0FBTyxDQUFDSyxTQUFSLENBQWtCQyxNQUFsQixDQUF5QixRQUF6QixDQUFKO0VBQUEsQ0FBakM7RUFDQVIsVUFBVSxDQUFDQyxPQUFYLENBQW1CLFVBQUFDLE9BQU87SUFBQSxPQUFJQSxPQUFPLENBQUNLLFNBQVIsQ0FBa0JDLE1BQWxCLENBQXlCLFFBQXpCLENBQUo7RUFBQSxDQUExQjtBQUNILENBUEQ7O0FBU0EsSUFBTUgsU0FBUyxHQUFHLFNBQVpBLFNBQVksQ0FBQ0gsT0FBRCxFQUFhO0VBQzNCSSxZQUFZO0VBQ1pKLE9BQU8sQ0FBQ0ssU0FBUixDQUFrQkUsR0FBbEIsQ0FBc0IsUUFBdEI7RUFDQSxJQUFNQyxLQUFLLEdBQUdSLE9BQU8sQ0FBQ1MsVUFBUixDQUFtQixDQUFuQixFQUFzQkMsWUFBdEIsQ0FBbUMsTUFBbkMsQ0FBZDtFQUNBLElBQU1DLEdBQUcsR0FBR2pCLFFBQVEsQ0FBQ2tCLGFBQVQsV0FBMEJKLEtBQTFCLEVBQVo7RUFDQUcsR0FBRyxDQUFDTixTQUFKLENBQWNFLEdBQWQsQ0FBa0IsUUFBbEI7QUFDSCxDQU5EOztBQVFBTSxPQUFPLENBQUNDLEdBQVIsQ0FBWSxxQkFBWiIsImZpbGUiOiIuL3NyYy9yZXNvdXJjZS9qcy9hbGV4YW5kcmEuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/resource/js/alexandra.js\n");

/***/ }),

/***/ "./src/resource/css/style.scss":
/*!*************************************!*\
  !*** ./src/resource/css/style.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvcmVzb3VyY2UvY3NzL3N0eWxlLnNjc3MuanMiLCJtYXBwaW5ncyI6IjtBQUFBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vYWxleGFuZHJhLy4vc3JjL3Jlc291cmNlL2Nzcy9zdHlsZS5zY3NzPzk5YzUiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/resource/css/style.scss\n");

/***/ }),

/***/ "./src/resource/css/alexandra.css":
/*!****************************************!*\
  !*** ./src/resource/css/alexandra.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvcmVzb3VyY2UvY3NzL2FsZXhhbmRyYS5jc3MuanMiLCJtYXBwaW5ncyI6IjtBQUFBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vYWxleGFuZHJhLy4vc3JjL3Jlc291cmNlL2Nzcy9hbGV4YW5kcmEuY3NzPzk1M2MiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/resource/css/alexandra.css\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/alexandra": 0,
/******/ 			"assets/css/alexandra": 0,
/******/ 			"assets/css/style": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkalexandra"] = self["webpackChunkalexandra"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/alexandra","assets/css/style"], () => (__webpack_require__("./src/resource/js/alexandra.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/alexandra","assets/css/style"], () => (__webpack_require__("./src/resource/css/style.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/alexandra","assets/css/style"], () => (__webpack_require__("./src/resource/css/alexandra.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;