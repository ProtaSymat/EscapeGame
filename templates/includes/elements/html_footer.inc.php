<script src="scripts/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
    function copyToClipboard(id) {
        let dummyElement = document.createElement('input');
        document.body.appendChild(dummyElement);
        let url = "./?page=enigme&layout=html&id=" + id;
        dummyElement.value = url;
        dummyElement.select();
        document.execCommand('copy');
        document.body.removeChild(dummyElement);

        alert("L'URL a été copiée dans le presse-papier !");
    }
</script>
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Escape Game Rouen 2024</p></div>
</footer>
</body>
</html>