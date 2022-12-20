const toast = $(".toast");
(closeIcon = $(".close")), (progress = $(".progress"));

let timer1, timer2;

// button.addEventListener("click", () => {
//     toast.classList.add("active");
//     progress.classList.add("active");

//     timer1 = setTimeout(() => {
//         toast.classList.remove("active");
//     }, 5000); //1s = 1000 milliseconds

//     timer2 = setTimeout(() => {
//         progress.classList.remove("active");
//     }, 5300);
// });

timer2 = setTimeout(() => {
    progress.removeClass("active");
}, 5300);

$(document).ready(() => {
    $(".close").click(() => {
        toast.removeClass("active");

        setTimeout(() => {
            progress.removeClass("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
});
