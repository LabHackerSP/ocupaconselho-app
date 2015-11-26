var gup = function (name ) {
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec( window.location.href );
      if( results == null )
        return "";
      else
        var result = results[1].substring(0,results[1].length);
        return decodeURIComponent(result).replace(/\+/g, " ")
    }

Handlebars.registerHelper('split', function(text) {
    var t = text.split(" ");
    return "<span class='tag'>" + t.join("</span> <span class='tag'>") + "</span>";
});
