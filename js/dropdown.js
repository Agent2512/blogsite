$(".dropdown-menu >div").click((e) => {
    var i = e.currentTarget.children[0].checked;

    if (i == false) {
        e.currentTarget.children[0].checked = true;
    }
    else if (i == true) { 
        e.currentTarget.children[0].checked = false;
    }

    setTimeout(() => {
        $(".dropdown-toggle").dropdown('toggle');
    }, 50);
});