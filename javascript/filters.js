(function () {
    var list_filters = document.getElementsByClassName("filters-img");

    function    unselectOtherFilters(array, exclude) {
        for (var i = 0; i < array.length; i++)
        {
            if (array[i] !== exclude)
                array[i].style.opacity = "0.5";;
        }
    }

    for (var i = 0; i < list_filters.length; i++)
    {
        list_filters[i].addEventListener('click', function (e) {
            unselectOtherFilters(list_filters, this);
            this.style.opacity = "1";
            e.preventDefault();
        }, false);
    }
})();