var blogs = $(".blog");

blogs.click((e) => {
    console.log();
    $(e.currentTarget.offsetParent).toggleClass("h-fit");
    $(e.currentTarget.offsetParent.children[1]).toggleClass("d-none");
});

blogs.parent().hover((e) => {
    if (e.type == "mouseleave") {
        $(e.currentTarget.children[1]).addClass("d-none");
        $(e.currentTarget).addClass("h-fit");
    }
});

