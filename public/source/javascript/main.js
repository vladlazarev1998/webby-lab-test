document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('#btn_search').addEventListener('click', () => {
        const value = document.querySelector("#search").value;
        window.location.href = "/filter?search=" + value;
    })
});