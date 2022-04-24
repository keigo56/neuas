/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/columnResize.js ***!
  \**************************************/
var tables = document.querySelectorAll('[datatable=true]');

var createResizableColumn = function createResizableColumn(table_id, col, resizer) {
  var session_data = JSON.parse(localStorage.getItem(table_id));

  if (session_data !== null) {
    var col_name = col.getAttribute('data-key');
    var column = session_data[col_name];

    if (column) {
      col.style.width = column['column_width'];
    }
  } // Track the current position of mouse


  var x = 0;
  var w = 0;

  var mouseDownHandler = function mouseDownHandler(e) {
    // Get the current mouse position
    x = e.clientX; // Calculate the current width of column

    var styles = window.getComputedStyle(col);
    w = parseInt(styles.width, 10); // Attach listeners for document's events

    document.addEventListener('mousemove', mouseMoveHandler);
    document.addEventListener('mouseup', mouseUpHandler);
    resizer.classList.add('resizing');
  };

  var mouseMoveHandler = function mouseMoveHandler(e) {
    // Determine how far the mouse has been moved
    var dx = e.clientX - x; // Update the width of column

    col.style.width = "".concat(w + dx, "px");
  }; // When user releases the mouse, remove the existing event listeners


  var mouseUpHandler = function mouseUpHandler() {
    document.removeEventListener('mousemove', mouseMoveHandler);
    document.removeEventListener('mouseup', mouseUpHandler);
    var session_data = JSON.parse(localStorage.getItem(table_id));
    var col_name = col.getAttribute('data-key');
    session_data[col_name] = {
      'column_width': col.style.width
    };
    localStorage.setItem(table_id, JSON.stringify(session_data));
    resizer.classList.remove('resizing');
  };

  resizer.addEventListener('mousedown', mouseDownHandler);
};

function makeColumnsResizable(table_id) {
  // Query the table
  var table = document.getElementById(table_id); // Query all headers

  var cols = table.querySelectorAll('.column'); // Loop over them

  [].forEach.call(cols, function (col) {
    // Create a resizer element
    var resizer = document.createElement('div');
    resizer.classList.add('resizer'); // Set the height

    resizer.style.height = "".concat(table.offsetHeight, "px"); // Add a resizer element to the column

    col.appendChild(resizer); // Will be implemented in the next section

    createResizableColumn(table_id, col, resizer);
  });
  if (localStorage.getItem(table_id) === null) localStorage.setItem(table_id, JSON.stringify({}));
  document.getElementById(table_id + '-wrapper').addEventListener('scroll', function (evt) {
    sessionStorage.setItem(table_id + '-scroll-position', evt.target.scrollLeft);
  });
}

function updateTableScrollPosition(table_id) {
  var x = sessionStorage.getItem(table_id + '-scroll-position') || 0;
  document.getElementById(table_id + '-wrapper').scrollTo(x, 0);
}

function resetTableScrollPosition(table_id) {
  sessionStorage.setItem(table_id + '-scroll-position', 0);
}

window.addEventListener('table-refreshed', function (event) {
  makeColumnsResizable(event.detail.table_id);
  updateTableScrollPosition(event.detail.table_id);
});
tables.forEach(function (table) {
  var table_id = table.id;
  makeColumnsResizable(table_id);
  resetTableScrollPosition(table_id);
});
/******/ })()
;