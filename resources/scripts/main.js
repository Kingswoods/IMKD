$(document).ready(function() {
    
    $(document).on('click', '#search__submit', function() {
        
        var query = $('#search__query').val().toLowerCase();
        
        if (query == "")
        {
            window.location.href = '../search?query=all';
        }
        else if(lookup__OS('windows', query))
        {
            window.location.href = '../search?query=' + query + '&OS=windows';
        }
        else if(lookup__OS('linux', query))
        {
            window.location.href = '../search?query=' + query + '&OS=linux';
        }
        else if(lookup__OS('mac', query))
        {
            window.location.href = '../search?query=' + query + '&OS=osx';
        }
        else if(lookup__OS('OSX', query))
        {
            window.location.href = '../search?query=' + query + '&OS=osx';
        }
        else
        {
            window.location.href = '../search?query=' + query;
        }
        
        return false;
    });
    
    
    
});

function lookup__OS(OS, query)
{
    return new RegExp( '\\b' + OS + '\\b', 'i').test(query);
}