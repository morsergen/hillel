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

/***/ "./resources/js/images-actions.js":
/*!****************************************!*\
  !*** ./resources/js/images-actions.js ***!
  \****************************************/
/***/ (() => {

eval("$(function () {\n  $(document).on('click', '.close_preview_btn', function (e) {\n    console.log(1111111111111111);\n    e.preventDefault();\n    var $btn = $(this);\n    $.ajax({\n      headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n      },\n      url: $btn.data('route'),\n      type: 'DELETE',\n      dataType: 'json',\n      success: function success(data) {\n        $btn.parent().remove();\n      },\n      error: function error(data) {\n        console.log('Error: ', data);\n      }\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW1hZ2VzLWFjdGlvbnMuanM/MzAyZCJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJvbiIsImUiLCJjb25zb2xlIiwibG9nIiwicHJldmVudERlZmF1bHQiLCIkYnRuIiwiYWpheCIsImhlYWRlcnMiLCJhdHRyIiwidXJsIiwiZGF0YSIsInR5cGUiLCJkYXRhVHlwZSIsInN1Y2Nlc3MiLCJwYXJlbnQiLCJyZW1vdmUiLCJlcnJvciJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQyxZQUFZO0FBQ1ZBLEVBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlDLEVBQVosQ0FBZSxPQUFmLEVBQXdCLG9CQUF4QixFQUE4QyxVQUFVQyxDQUFWLEVBQWE7QUFBQ0MsSUFBQUEsT0FBTyxDQUFDQyxHQUFSLENBQVksZ0JBQVo7QUFDeERGLElBQUFBLENBQUMsQ0FBQ0csY0FBRjtBQUNBLFFBQUlDLElBQUksR0FBR1AsQ0FBQyxDQUFDLElBQUQsQ0FBWjtBQUVBQSxJQUFBQSxDQUFDLENBQUNRLElBQUYsQ0FBTztBQUNIQyxNQUFBQSxPQUFPLEVBQUU7QUFBRSx3QkFBZ0JULENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCVSxJQUE3QixDQUFrQyxTQUFsQztBQUFsQixPQUROO0FBRUhDLE1BQUFBLEdBQUcsRUFBRUosSUFBSSxDQUFDSyxJQUFMLENBQVUsT0FBVixDQUZGO0FBR0hDLE1BQUFBLElBQUksRUFBRSxRQUhIO0FBSUhDLE1BQUFBLFFBQVEsRUFBRSxNQUpQO0FBS0hDLE1BQUFBLE9BQU8sRUFBRSxpQkFBVUgsSUFBVixFQUFnQjtBQUNyQkwsUUFBQUEsSUFBSSxDQUFDUyxNQUFMLEdBQWNDLE1BQWQ7QUFDSCxPQVBFO0FBUUhDLE1BQUFBLEtBQUssRUFBRSxlQUFVTixJQUFWLEVBQWdCO0FBQ25CUixRQUFBQSxPQUFPLENBQUNDLEdBQVIsQ0FBWSxTQUFaLEVBQXVCTyxJQUF2QjtBQUNIO0FBVkUsS0FBUDtBQVlILEdBaEJEO0FBaUJILENBbEJBLENBQUQiLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uICgpIHtcbiAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnLmNsb3NlX3ByZXZpZXdfYnRuJywgZnVuY3Rpb24gKGUpIHtjb25zb2xlLmxvZygxMTExMTExMTExMTExMTExKTtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgJGJ0biA9ICQodGhpcyk7XG5cbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIGhlYWRlcnM6IHsgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JykgfSxcbiAgICAgICAgICAgIHVybDogJGJ0bi5kYXRhKCdyb3V0ZScpLFxuICAgICAgICAgICAgdHlwZTogJ0RFTEVURScsXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAkYnRuLnBhcmVudCgpLnJlbW92ZSgpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKCdFcnJvcjogJywgZGF0YSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0pO1xufSk7XG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2ltYWdlcy1hY3Rpb25zLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/images-actions.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/images-actions.js"]();
/******/ 	
/******/ })()
;