$(document).ready(function() {
    
    $(document).on('click', '.menu__item', function() {
        
        var url = window.location.href;
        var param = 'OS';
        var value = $(this).data('identifier');
        
        if (value == 'all')
        {
            window.location.href = removeUrlParam(url, param);
        }
        else
        {
            window.location.href = replaceUrlParam(url, param, value);
        }
        
    });
    
    $(document).on('click', '.sub__item', function() {
        
        var url = window.location.href;
        var param = 'entity';
        var value = $(this).data('identifier');
        
        if (value == 'all')
        {
            window.location.href = removeUrlParam(url, param);
        }
        else
        {
            window.location.href = replaceUrlParam(url, param, value);
        }
        
    });
    
    $(document).on('click', '#search__submit', function() {
        
        var url = window.location.href;
        var param = 'query';
        var query = $('#search__query').val().toLowerCase();
        
        if (query == "")
        {
            window.location.href = '../search?query=all';
        }
        else
        {
            window.location.href = replaceUrlParam(url, param, query);
        }
        
        return false;
    });
    
});

function replaceUrlParam(url, param, value)
{
    var pattern = new RegExp('\\b('+param+'=).*?(&|$)');
    
    if (url.search(pattern) >= 0)
    {
        return url.replace(pattern, '$1' + value + '$2');
    }
    
    return url + (url.indexOf('?') > 0 ? '&' : '?') + param + '=' + value;
}

function removeUrlParam(url, param)
{
    var parts = url.split('?');
    
    if (parts.length >= 2)
    {
        var url__base = parts.shift();
        
        var query = parts.join('?');
        
        var prefix = encodeURIComponent(param)+'=';
        
        var pars = query.split(/[&;]/g);
        
        for (var i = pars.length; i --> 0;)
        {
            if (pars[i].lastIndexOf(prefix, 0) !== -1)
            {
                pars.splice(i, 1);
            }
        }
        
        url = url__base + '?' + pars.join('&');
    }
    
    return url;
}
