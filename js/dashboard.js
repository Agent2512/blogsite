var blogs = $(".blog");

blogs.click((e) => {
    $(e.currentTarget.offsetParent.children[1]).toggleClass("d-none");

    $(e.currentTarget.offsetParent).toggleClass("h-fit");
    $(e.currentTarget.offsetParent).toggleClass(e.currentTarget.offsetParent.dataset.css);
});

blogs.parent().hover((e) => {
    if (e.type == "mouseleave") {
        $(e.currentTarget.children[1]).addClass("d-none");

        $(e.currentTarget).addClass("h-fit");
        $(e.currentTarget).removeClass(e.currentTarget.dataset.css);

    }
});

