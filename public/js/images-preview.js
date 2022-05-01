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

/***/ "./resources/js/images-preview.js":
/*!****************************************!*\
  !*** ./resources/js/images-preview.js ***!
  \****************************************/
/***/ (() => {

eval("if (window.FileReader) {\n  document.getElementById(\"images\").onchange = function () {\n    var counter = -1,\n        file; //$('.images-wrapper').html('');\n\n    var template = \"<div class=\\\"col-sm-4 justify-content-center align-items-center position-relative\\\">\\n                                    <img src=\\\"__url__\\\" class=\\\"card-img-top\\\" style=\\\"max-width: 80%; margin: 0 auto; display: block;\\\">\\n                                </div>\";\n\n    while (file = this.files[++counter]) {\n      var reader = new FileReader();\n\n      reader.onloadend = function () {\n        return function () {\n          var img = template.replace('__url__', this.result);\n          $('.images-wrapper').append(img);\n        };\n      }(file);\n\n      reader.readAsDataURL(file);\n    }\n  };\n}\n\n$(document).ready(function (e) {\n  $('#thumbnail').change(function () {\n    var reader = new FileReader();\n\n    reader.onload = function (e) {\n      $('#thumbnail-preview').attr('src', e.target.result);\n    };\n\n    reader.readAsDataURL(this.files[0]);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaW1hZ2VzLXByZXZpZXcuanM/YTQwOCJdLCJuYW1lcyI6WyJ3aW5kb3ciLCJGaWxlUmVhZGVyIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIm9uY2hhbmdlIiwiY291bnRlciIsImZpbGUiLCJ0ZW1wbGF0ZSIsImZpbGVzIiwicmVhZGVyIiwib25sb2FkZW5kIiwiaW1nIiwicmVwbGFjZSIsInJlc3VsdCIsIiQiLCJhcHBlbmQiLCJyZWFkQXNEYXRhVVJMIiwicmVhZHkiLCJlIiwiY2hhbmdlIiwib25sb2FkIiwiYXR0ciIsInRhcmdldCJdLCJtYXBwaW5ncyI6IkFBQUEsSUFBSUEsTUFBTSxDQUFDQyxVQUFYLEVBQXVCO0FBQ25CQyxFQUFBQSxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsUUFBeEIsRUFBa0NDLFFBQWxDLEdBQTZDLFlBQVk7QUFDckQsUUFBSUMsT0FBTyxHQUFHLENBQUMsQ0FBZjtBQUFBLFFBQWtCQyxJQUFsQixDQURxRCxDQUdyRDs7QUFFQSxRQUFJQyxRQUFRLDZRQUFaOztBQUlBLFdBQU9ELElBQUksR0FBRyxLQUFLRSxLQUFMLENBQVcsRUFBRUgsT0FBYixDQUFkLEVBQXFDO0FBQ2pDLFVBQUlJLE1BQU0sR0FBRyxJQUFJUixVQUFKLEVBQWI7O0FBQ0FRLE1BQUFBLE1BQU0sQ0FBQ0MsU0FBUCxHQUFvQixZQUFZO0FBQzVCLGVBQU8sWUFBWTtBQUNmLGNBQUlDLEdBQUcsR0FBR0osUUFBUSxDQUFDSyxPQUFULENBQWlCLFNBQWpCLEVBQTRCLEtBQUtDLE1BQWpDLENBQVY7QUFDQUMsVUFBQUEsQ0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJDLE1BQXJCLENBQTRCSixHQUE1QjtBQUNILFNBSEQ7QUFJSCxPQUxrQixDQUtoQkwsSUFMZ0IsQ0FBbkI7O0FBTUFHLE1BQUFBLE1BQU0sQ0FBQ08sYUFBUCxDQUFxQlYsSUFBckI7QUFDSDtBQUNKLEdBbkJEO0FBb0JIOztBQUVEUSxDQUFDLENBQUNaLFFBQUQsQ0FBRCxDQUFZZSxLQUFaLENBQWtCLFVBQVVDLENBQVYsRUFBYTtBQUMzQkosRUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQkssTUFBaEIsQ0FBdUIsWUFBWTtBQUMvQixRQUFJVixNQUFNLEdBQUcsSUFBSVIsVUFBSixFQUFiOztBQUNBUSxJQUFBQSxNQUFNLENBQUNXLE1BQVAsR0FBZ0IsVUFBQ0YsQ0FBRCxFQUFPO0FBQ25CSixNQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3Qk8sSUFBeEIsQ0FBNkIsS0FBN0IsRUFBb0NILENBQUMsQ0FBQ0ksTUFBRixDQUFTVCxNQUE3QztBQUNILEtBRkQ7O0FBR0FKLElBQUFBLE1BQU0sQ0FBQ08sYUFBUCxDQUFxQixLQUFLUixLQUFMLENBQVcsQ0FBWCxDQUFyQjtBQUNILEdBTkQ7QUFPSCxDQVJEIiwic291cmNlc0NvbnRlbnQiOlsiaWYgKHdpbmRvdy5GaWxlUmVhZGVyKSB7XG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbWFnZXNcIikub25jaGFuZ2UgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGxldCBjb3VudGVyID0gLTEsIGZpbGU7XG5cbiAgICAgICAgLy8kKCcuaW1hZ2VzLXdyYXBwZXInKS5odG1sKCcnKTtcblxuICAgICAgICBsZXQgdGVtcGxhdGUgPSBgPGRpdiBjbGFzcz1cImNvbC1zbS00IGp1c3RpZnktY29udGVudC1jZW50ZXIgYWxpZ24taXRlbXMtY2VudGVyIHBvc2l0aW9uLXJlbGF0aXZlXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW1nIHNyYz1cIl9fdXJsX19cIiBjbGFzcz1cImNhcmQtaW1nLXRvcFwiIHN0eWxlPVwibWF4LXdpZHRoOiA4MCU7IG1hcmdpbjogMCBhdXRvOyBkaXNwbGF5OiBibG9jaztcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+YDtcblxuICAgICAgICB3aGlsZSAoZmlsZSA9IHRoaXMuZmlsZXNbKytjb3VudGVyXSkge1xuICAgICAgICAgICAgbGV0IHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XG4gICAgICAgICAgICByZWFkZXIub25sb2FkZW5kID0gKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICBsZXQgaW1nID0gdGVtcGxhdGUucmVwbGFjZSgnX191cmxfXycsIHRoaXMucmVzdWx0KTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLmltYWdlcy13cmFwcGVyJykuYXBwZW5kKGltZylcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KShmaWxlKTtcbiAgICAgICAgICAgIHJlYWRlci5yZWFkQXNEYXRhVVJMKGZpbGUpO1xuICAgICAgICB9XG4gICAgfVxufVxuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoZSkge1xuICAgICQoJyN0aHVtYm5haWwnKS5jaGFuZ2UoZnVuY3Rpb24gKCkge1xuICAgICAgICBsZXQgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcbiAgICAgICAgcmVhZGVyLm9ubG9hZCA9IChlKSA9PiB7XG4gICAgICAgICAgICAkKCcjdGh1bWJuYWlsLXByZXZpZXcnKS5hdHRyKCdzcmMnLCBlLnRhcmdldC5yZXN1bHQpO1xuICAgICAgICB9XG4gICAgICAgIHJlYWRlci5yZWFkQXNEYXRhVVJMKHRoaXMuZmlsZXNbMF0pO1xuICAgIH0pO1xufSk7XG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2ltYWdlcy1wcmV2aWV3LmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/images-preview.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/images-preview.js"]();
/******/ 	
/******/ })()
;