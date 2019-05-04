// Selection and display of the filter image on top of camera-box
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

    for (var i = 0; i < list_filters.length; i++)
    {
        list_filters[i].addEventListener('click', function (e) {
            unselectOtherFilters(list_filters, this);
            this.style.opacity = "1";
            filter_selected = true;
            if (this !== list_filters[0])
            {
                filter_active.style.display = "block";
                filter_active.src = this.src;
            }
            else
                filter_active.style.display = "none";
            if (filter_selected == true)
                document.getElementById('camera-snap-btn').disabled = false;
            e.preventDefault();
        }, false);
    }
})();

// Moving the filter image on top of the camera-box
var filter = document.querySelector("#filter-img-active");
var box = document.querySelector("#camera-box");

box.addEventListener("click", getClickPosition, false);

function getClickPosition(e) {
    var parentPosition = getPosition(e.currentTarget);
    var xPosition = e.clientX - parentPosition.x - (filter.clientWidth / 2);
    var yPosition = e.clientY - parentPosition.y - (filter.clientHeight / 2);

    filter.style.left = xPosition + "px";
    filter.style.top = yPosition + "px";
}

function getPosition(el) {
    var xPos = 0;
    var yPos = 0;

    while (el) {
    if (el.tagName == "BODY") {
        var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
        var yScroll = el.scrollTop || document.documentElement.scrollTop;

        xPos += (el.offsetLeft - xScroll + el.clientLeft);
        yPos += (el.offsetTop - yScroll + el.clientTop);
        } else {
            xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
            yPos += (el.offsetTop - el.scrollTop + el.clientTop);
        }
        el = el.offsetParent;
    }
    return {
        x: xPos,
        y: yPos
    };
}
