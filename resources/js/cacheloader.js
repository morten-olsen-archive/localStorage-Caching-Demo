(function () {
    function selfdestruct() {
        localStorage.removeItem('lfc');
        document.cookie = 's=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
        location.reload();
    }
    var ce = localStorage.getItem('lfc');
    window.cache = {};
    if (ce !== null) {
        try {
            cache = JSON.parse(ce);
        } catch (err) {
            selfdestruct();
        }
    }
    function loadCache() {
        var elements = document.querySelectorAll('meta[data-rendered=false]');
        for (var i = elements.length - 1; i >= 0; i--) {
            var attr = elements[i].attributes,
                name = attr['data-name'].value,
                version = attr['data-version'].value,
                item = cache[name];
            if (typeof item === 'undefined'
				|| item.version !== version
				|| (item.data.length !== item.size && item.size != 0)) {
                selfdestruct();
                return;
            }
            var elm = document.createElement(item.type);
            elm.innerHTML = item.data;
            elements[i].attributes['data-rendered'].value = 'true';
            elements[i].parentNode.insertBefore(elm, elements[i]);
        }
    }
    loadCache();
    window.loadCache = loadCache;
})();