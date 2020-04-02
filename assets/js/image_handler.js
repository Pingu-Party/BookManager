/* Handling of broken images */
(function () {
    const BrokenImageHandler = function () {

    };
    BrokenImageHandler.prototype.handle = function (event) {
        //Get target
        let target = $(event.target);

        //Create stub element as replacement
        let stubElement = $('<div>').addClass('broken-image-stub');

        //Replace
        target.replaceWith(stubElement);

        console.log(event);
    };

    //Export as singleton
    window.BrokenImageHandler = new BrokenImageHandler();
})();