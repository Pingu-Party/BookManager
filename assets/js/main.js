/* Constants*/
const SEARCH_RESULT_CONTAINER = '#results-container';

/*
Client for issuing server requests
 */
(function () {
    const URL_GET_BOOKS_QUERY = "/search/query?query=";
    const URL_GET_BOOKS_CATEGORY = "/search/category?category=";
    const URL_DELETE_BOOK = "/delete/";
    const URL_DELETE_CATEGORY = "/categories/delete/";
    const Client = function () {
    };
    Client.prototype.getBooksByQuery = function (query) {
        return $.get(URL_GET_BOOKS_QUERY + query);
    };
    Client.prototype.getBooksByCategory = function (category) {
        return $.get(URL_GET_BOOKS_CATEGORY + category);
    };
    Client.prototype.deleteBook = function (bookID) {
        return $.post(URL_DELETE_BOOK + bookID);
    };
    Client.prototype.deleteCategory = function (categoryID) {
        return $.post(URL_DELETE_CATEGORY + categoryID);
    };
    //Export as Singleton
    window.Client = new Client();
}());

/*
Deletion of categories
 */
(function () {
    const CategoryDeletion = function () {

    };
    CategoryDeletion.prototype.delete = function (categoryID, categoryName, bookNumber, callback) {
        //Sanitize parameters
        callback = callback || function () {
        };

        //Callback function in case the category is supposed to be deleted
        function deleteCategory() {
            //Perform request
            Client.deleteCategory(categoryID).done(function (response) {
                //Execute callback
                callback(response);
            }).fail(function () {
                new UserInfo("Löschen fehlgeschlagen", "Die Kategorie konnte nicht gelöscht werden, möglicherweise existiert sie nicht.").show();
            });
        }

        //Ask the user if he is sure to delete the category
        let warning = new UserWarning("<span class='glyphicon glyphicon-trash'></span>&nbsp;Kategorie löschen", "Soll die Kategorie \"" +
            categoryName + "\" wirklich gelöscht werden? Sie enthält " + bookNumber +
            " Bücher, die dann ebenfalls gelöscht werden. Diese Aktion kann nicht rückgängig gemacht werden!",
            "Löschen", deleteCategory);

        //Show warning
        warning.show();
    };
    CategoryDeletion.prototype.deleteWithReload = function (event, categoryID, categoryName, bookNumber) {
        //Prevent default action
        event.preventDefault();

        //Delete
        this.delete(categoryID, categoryName, bookNumber, function () {
            //Reload page on callback
            window.location.replace(window.location.pathname + window.location.search + window.location.hash);
        });
    };

    //Export as Singleton
    window.CategoryDeletion = new CategoryDeletion();
})();

/*
Deletion of books
 */
(function () {
    const BookDeletion = function () {

    };
    BookDeletion.prototype.delete = function (bookID, bookTitle, callback) {
        //Sanitize parameters
        callback = callback || function () {
        };

        //Callback function in case the book is supposed to be deleted
        function deleteBook() {
            //Perform request
            Client.deleteBook(bookID).done(function (response) {
                //Execute callback
                callback(response);
            }).fail(function () {
                new UserInfo("Löschen fehlgeschlagen", "Das Buch konnte nicht gelöscht werden, möglicherweise existiert es nicht.").show();
            });
        }

        //Ask the user if he is sure to delete the book
        let warning = new UserWarning("<span class='glyphicon glyphicon-trash'></span>&nbsp;Buch löschen", "Soll das Buch \"" +
            bookTitle + "\" wirklich gelöscht werden? Diese Aktion kann nicht rückgängig gemacht werden!",
            "Löschen", deleteBook);

        //Show warning
        warning.show();
    };
    BookDeletion.prototype.deleteWithReload = function (event, bookID, bookTitle) {
        //Prevent default action
        event.preventDefault();

        //Delete
        this.delete(bookID, bookTitle, function () {
            //Reload page on callback
            location.reload();
        });
    };
    BookDeletion.prototype.deleteWithRedirect = function (event, bookID, bookTitle) {
        //Prevent default action
        event.preventDefault();

        //Delete
        this.delete(bookID, bookTitle, function () {
            //Load home page
            window.location.href = BASE_PATH;
        });
    };

    //Export as Singleton
    window.BookDeletion = new BookDeletion();
})();

/*
Table localisation
 */
(function () {
    //Export
    window.TableLocalisation = {
        'de': {
            processing: "Verarbeite...",
            search: "Suche:",
            lengthMenu: "Zeige _MENU_ Ergebnisse",
            info: "Zeige Ergebnisse _START_ bis _END_ von _TOTAL_",
            infoEmpty: "Zeige 0 von 0 Ergebnissen",
            infoFiltered: "(gefiltert aus _MAX_ Ergebnissen)",
            infoPostFix: "",
            loadingRecords: "Lade Ergebnisse...",
            zeroRecords: "Keine Ergebnisse gefunden.",
            emptyTable: "Keine Ergebnisse gefunden.",
            paginate: {
                first: "Erste",
                previous: "Vorherige",
                next: "Nächste",
                last: "Letzte"
            },
            aria: {
                sortAscending: ": Aufsteigend sortieren",
                sortDescending: ": Absteigend sortieren"
            }
        }
    };
})();

/*
Table renderer functions
 */
(function () {
    const TableRenderer = function () {
    };
    TableRenderer.prototype.renderBookThumbnail = function (data, type, row) {
        //Render link as image element
        return '<img class="thumbnail" src="' + data + '" onerror="BrokenImageHandler.handle(event)">';
    };
    TableRenderer.prototype.renderBookTitle = function (data, type, row) {
        return '<a href="' + BASE_PATH + "/book/" + row.id + '">' + data + '</a>';
    };
    TableRenderer.prototype.renderCategoryName = function (data, type, row) {
        return '<span class="label label-default">' + data + '</span>';
    };
    TableRenderer.prototype.renderActions = function (data, type, row) {
        return '<div class="row-buttons text-nowrap">' +
            '<form action="' + BASE_PATH + 'edit/' + data + '"><button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></form>' +
            '&nbsp;' +
            '<form onsubmit="BookDeletion.deleteWithReload(event, ' + data + ', \'' + row.title + '\')"><button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></form>' +
            '</div>';
    };
    //Export as Singleton
    window.TableRenderer = new TableRenderer();
})();

/*
Modal dialog to display information to the user.
 */
(function () {
    const UserInfo = function (title, content) {
        this.element = $('<div class="modal fade" tabindex="-1" role="dialog">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
            '</div>' +
            '<div class="modal-body">' + content +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary" name="abort" data-dismiss="modal">Schließen</button>' +
            '</div></div></div>');

        //Destroy modal after is has closed
        this.element.on('hidden.bs.modal', () => {
            this.element.remove();
        });
    };
    UserInfo.prototype.show = function () {
        //Add to DOM
        $('body').append(this.element);

        //Show info as modal
        this.element.modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    };
    //Export
    window.UserInfo = UserInfo;
})();

/*
Modal dialog to display a warning message and ask the user if he is sure.
 */
(function () {
    const UserWarning = function (title, content, acceptText, acceptCallback, abortCallback) {
        //Sanitize parameters
        acceptCallback = acceptCallback || function () {
        };
        abortCallback = abortCallback || function () {
        };

        this.element = $('<div class="modal fade" tabindex="-1" role="dialog">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
            '</div>' +
            '<div class="modal-body">' + content +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-danger" name="accept" data-dismiss="modal">' + acceptText + '</button>' +
            '<button type="button" class="btn btn-primary" name="abort" data-dismiss="modal">Abbrechen</button>' +
            '</div></div></div>');

        //Register callback
        this.element.find('button').on('click', function () {
            let button = $(event.target);

            //Check for button
            switch (button.attr('name')) {
                case "accept":
                    acceptCallback();
                    break;
                default:
                    abortCallback();
            }
        });

        //Destroy modal after is has closed
        this.element.on('hidden.bs.modal', () => {
            this.element.remove();
        });
    };
    UserWarning.prototype.show = function () {
        //Add to DOM
        $('body').append(this.element);

        //Show warning as modal
        this.element.modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    };
    //Export
    window.UserWarning = UserWarning;
})();

/*
Throbber
 */
(function () {
    const Throbber = function () {
        this.element = $('<div class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"><div class="modal-body text-center"><div class="loader"/><p class="loader-text"></p></div></div></div></div>');
    };
    Throbber.prototype.show = function (text) {
        //Check if element has already been initialized
        if (!this.initialized) {
            $("body").append(this.element);
        }

        //Sanity check for text
        text = text || "";

        //Update text
        this.element.find('.loader-text').html(text);

        //Show throbber as modal
        this.element.modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    };
    Throbber.prototype.hide = function () {
        this.element.modal("hide");
    };
    //Export as Singleton
    window.Throbber = new Throbber();
}());

const initDOM = function () {

    /* Required DOM elements */
    const PLAIN_RESULT_TABLE = $("#results-table");
    const PLAIN_CATEGORY_TABLE = $("#category-table");
    const PLAIN_CATEGORY_MANAGE_TABLE = $("#category-manage-table");
    const SEARCH_FORM = $("#search-form");
    const SEARCH_PANEL = $("#search-panel");
    const RESULTS_TAB = $('a[href="#results-container"]');
    const RESULTS_CONTAINER = $('#results-container');
    const CATEGORY_CONTAINER = $('#category-container');

    //Apply DataTables plugin to the tables
    const RESULT_TABLE = PLAIN_RESULT_TABLE.DataTable({
        data: [],
        columns: [
            {
                data: 'thumbnailURL',
                render: TableRenderer.renderBookThumbnail
            },
            {
                data: 'title',
                render: TableRenderer.renderBookTitle
            },
            {
                data: 'category_name',
                render: TableRenderer.renderCategoryName
            },
            {data: 'authors'},
            {data: 'location'},
            {data: 'created'},
            {
                data: 'id',
                orderable: false,
                bSearchable: false,
                render: TableRenderer.renderActions
            }
        ],
        language: TableLocalisation.de
    });

    const CATEGORY_TABLE = PLAIN_CATEGORY_TABLE.DataTable({
        data: [],
        columns: [
            {
                data: 'thumbnailURL',
                render: TableRenderer.renderBookThumbnail
            },
            {
                data: 'title',
                render: TableRenderer.renderBookTitle
            },
            {data: 'authors'},
            {data: 'publisher'},
            {data: 'location'},
            {data: 'created'},
            {
                data: 'id',
                orderable: false,
                bSearchable: false,
                render: TableRenderer.renderActions
            }
        ],
        language: TableLocalisation.de
    });

    const CATEGORY_MANAGE_TABLE = PLAIN_CATEGORY_MANAGE_TABLE.DataTable({
        columns: [
            {data: 'name'},
            {data: 'created'},
            {data: 'number'},
            {
                data: 'actions',
                bSearchable: false,
                orderable: false
            }
        ],
        aLengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        iDisplayLength: -1,
        language: TableLocalisation.de
    });

    //Add listener to the search form
    SEARCH_FORM.on('submit', function (event) {
        //Stop event propagation and page reload
        event.preventDefault();

        //Get form data
        let data = $(this).serializeArray();

        //Determine query string
        let queryString = "";
        $.each(data, function (index, element) {
            if (element.name === 'query') {
                queryString = element.value;
            }
        });

        //Perform server request to get books by query
        Throbber.show("Lade Ergebnisse...");
        Client.getBooksByQuery(queryString).done(function (response) {
            //Parse response
            let data = JSON.parse(response);

            //Update table
            RESULT_TABLE.clear();
            RESULT_TABLE.rows.add(data).draw();

            //Show results tab
            RESULTS_TAB.tab('show');

            //Scroll to results container
            $('html, body').animate({
                scrollTop: RESULTS_CONTAINER.offset().top
            }, 1500);

            //Hide throbber
            Throbber.hide();
        });
    });

    //Add listener to the search panel tabs
    SEARCH_PANEL.find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //Determine target
        let target = $(e.target);

        //Abort if user selected the search results tab
        if (target.attr("href") === SEARCH_RESULT_CONTAINER) {
            return;
        }

        //Get selected category
        let category = target.attr('name');

        //Perform server request to get books by category
        Throbber.show("Lade Kategorie...");
        Client.getBooksByCategory(category).done(function (response) {
            //Parse response
            let data = JSON.parse(response);

            //Update table
            CATEGORY_TABLE.clear();
            CATEGORY_TABLE.rows.add(data).draw();

            //Scroll to results container
            $('html, body').animate({
                scrollTop: CATEGORY_CONTAINER.offset().top
            }, 1500);

            //Hide throbber
            Throbber.hide();
        });
    });

    //Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
};

$(document).ready(initDOM);