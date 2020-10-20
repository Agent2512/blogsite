var currentFile = document.location.pathname.split("/").pop().split(".").shift();

$(".nav-link").each((e) => {
    var navLink = $($(".nav-link")[e])[0].href.split("/").pop().split(".").shift();

    if (currentFile == navLink) {
        $($(".nav-link")[e]).addClass("border rounded bg-dark")
        console.log($($(".nav-link")[e]));
    }
});
