(function () {
    var list_filters = document.getElementsByClassName("filters-img");
    var filter_selected = false;
    var filter_active = document.getElementById("filter-img-active");

    function    unselectOtherFilters(array, exclude) {
        for (var i = 0; i < array.length; i++)
        {
            if (array[i] !== exclude)
                array[i].style.opacity = "0.5";;
        }
    }
    if (filter_selected == false)
        list_filters[0].style.opacity = "1";

    for (var i = 0; i < list_filters.length; i++)
    {
        list_filters[i].addEventListener('click', function (e) {
            unselectOtherFilters(list_filters, this);
            this.style.opacity = "1";
            if (this !== list_filters[0])
            {
                filter_selected = true;
                filter_active.style.display = "block";
                filter_active.src = this.src;
            }
            else
                filter_active.style.display = "none";
            e.preventDefault();
        }, false);
    }
})();