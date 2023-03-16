/* Possible Upgrade is using firstChildElement and nextElementSiblings
   should they work well with IE
   to bypass working with childnodes, or just use childNodes to apease IE */

$(document).ready(() => {
    var tabs = document.getElementsByClassName("tabs");

    for (let i = 0; i < tabs.length; i++) {
        for (let x = 0; x < tabs[i].children[0].children.length; x++) {
            tabs[i].children[0].children[x].addEventListener(
                "click",
                function (e) {
                    for (
                        let z = 0;
                        z < tabs[i].children[0].children.length;
                        z++
                    ) {
                        tabs[i].children[0].children[z].className = "";
                    }
                    for (
                        let y = 0;
                        y < tabs[i].nextElementSibling.children.length;
                        y++
                    ) {
                        tabs[i].nextElementSibling.children[y].className =
                            "tab-pane";
                        if (
                            tabs[i].nextElementSibling.children[y].id ==
                            this.children[0].id
                        ) {
                            this.className = "is-active";
                            tabs[i].nextElementSibling.children[y].className =
                                "tab-pane is-active";
                        }
                    }
                }
            );
        }
    }
});
