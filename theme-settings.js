// Color presets
var color_presets = [
  {
    name: "Firebrick",
    front_header_left: "#5c1d26",
    front_header_right: "#371117",
    footer_center: "#5c1d26",
    footer_outside: "#371117",
    features: "#5c1d26"
  },
  {
    name: "Peacock",
    front_header_left: "#1E5772",
    front_header_right: "#518AA5",
    footer_center: "#518AA5",
    footer_outside: "#1E5772",
    features: "#1E5772"
  },
  {
    name: "Spruce",
    front_header_left: "#36423A",
    front_header_right: "#69756D",
    footer_center: "#69756D",
    footer_outside: "#36423A",
    features: "#36423A"
  },
  {
    name: "Mandarin",
    front_header_left: "#CA5420",
    front_header_right: "#A2431A",
    footer_center: "#CA5420",
    footer_outside: "#A2431A",
    features: "#CA5420"
  },
  {
    name: "Lime",
    front_header_left: "#6C6F16",
    front_header_right: "#41430D",
    footer_center: "#6C6F16",
    footer_outside: "#41430D",
    features: "#6C6F16"
  },
  {
    name: "Cool Neutral",
    front_header_left: "#6A6A6A",
    front_header_right: "#8D8D8D",
    footer_center: "#8D8D8D",
    footer_outside: "#6A6A6A",
    features: "#6A6A6A"
  },
  {
    name: "Warm Neutral",
    front_header_left: "#3A3630",
    front_header_right: "#736C61",
    footer_center: "#736C61",
    footer_outside: "#3A3630",
    features: "#736C61"
  },
];

// Update the preview image(s)
function updateThemePreview(){
  var layout = $("input:radio[name='quickSites_layout']:checked").val();
  var theme = $("input:radio[name='quickSites_theme']:checked").val();
  var previewImg = $("#theme_preview");

  // Force the wrapper's height
  previewImg.parent().height(previewImg.height());

  // Only show color settings if theme == 0
  if(theme == 0){
    $('#color_settings').show();
  }else{
    $('#color_settings').hide();
  }

  $("#theme_preview").attr("src", $("#theme_preview").attr("src")
      .replace(/\/theme-\d+\//, "/theme-"+theme+"/")
      .replace(/\/preview-[a-z]+/, "/preview-"+layout));

  if($("input:radio[name='quickSites_theme_header']:checked").val() == ''){
    $("#theme_preview_header").hide();
  }else{
    $("#theme_preview_header")
      .show()
      .css(
        "background-image",
        'url('
        + $("#theme_preview").attr("src")
          .replace(/\/theme-\d*\//, "/theme-"+$("input:radio[name='quickSites_theme_header']:checked").val()+"/")
        + ')'
      );
  }

  if($("input:radio[name='quickSites_theme_footer']:checked").val() == ''){
    $("#theme_preview_footer").hide();
  }else{
    $("#theme_preview_footer")
      .show()
      .css(
        "background-image",
        'url('
        + $("#theme_preview").attr("src")
          .replace(/\/theme-\d*\//, "/theme-"+$("input:radio[name='quickSites_theme_footer']:checked").val()+"/")
        + ')'
      );
  }
  if(layout == 'c'){
    $("#theme_preview_footer_color").css("bottom", "100px");
    $("#theme_preview_features_color").hide();
  }else{
    $("#theme_preview_footer_color").css("bottom", "1px");
    $("#theme_preview_features_color").show();
  }
}

// Image preloading
(function($) {
  var cache = [];
  // Arguments are image paths relative to the current page.
  $.preLoadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
  }
})(jQuery);


// Initialization
$(document).ready(function(){
  // Attach color fields to their preview divs
  // Front Header
  $("#edit-quickSites-front-header-left-color, #edit-quickSites-front-header-right-color").change(function(){
    var val1 = $('#edit-quickSites-front-header-left-color').val();
    var val2 = $('#edit-quickSites-front-header-right-color').val();
    $("#theme_preview_front_header_color")
      .css("background-color", val1)
      .css("background-image", "-webkit-gradient(linear,75% center,right center,from("+val1+"),to("+val2+"))")
      .css("background-image", "-moz-linear-gradient(left,"+val1+" 75%,"+val2+" 100%)");
  });
  // Features
  $("#edit-quickSites-features-color").change(function(){
    var val = $(this).val();
    $("#theme_preview_features_color").css("background-color", val);
  });
  // Footer
  $("#edit-quickSites-footer-center-color, #edit-quickSites-footer-outside-color").change(function(){
    var val1 = $('#edit-quickSites-footer-center-color').val();
    var val2 = $('#edit-quickSites-footer-outside-color').val();
    $("#theme_preview_footer_color")
      .css("background-color", val2)
      .css("background-image", "-webkit-gradient(radial,50% center,0,center center,250,from("+val1+"),to("+val2+"))")
      .css("background-image", "-moz-radial-gradient(50% center, circle farthest-corner,"+val1+","+val2+")");
  });

  // Initialize color picker
  var cp = $('#colorPicker');
  var cp_inputs = $('input.form-text[id*="color"]');
  cp.farbtastic();
  cp_inputs
    .focus(function(){
      $.farbtastic(cp).linkTo(this);
      $('#colorPickerLabel').text($(this).siblings('label').text());
    })
    .focus().blur().change()
  ;

  // Add the presets to the select list
  var cp_select = $('#color_preset');
  for(var i = 0; i < color_presets.length; i++){
    cp_select.append('<option value='+i+'>'+color_presets[i].name+'</option>');
  }
  cp_select.change(function(){
    var selected = $(this).val();

    // Preserve the selected field
    var linked = $.farbtastic(cp).callback;

    if(color_presets[selected]){
      for(i in color_presets[selected]){
        if(i != "name"){
          $.farbtastic(cp).linkTo('#edit-quickSites-'+i.replace(/_/g,'-')+'-color').setColor(color_presets[selected][i]);
        }
      }
    }
    // Restore the selected field
    $.farbtastic(cp).linkTo(linked);
  });

  // Initialize preview updating
  $("input:radio[name='quickSites_theme'], input:radio[name='quickSites_theme_header'], input:radio[name='quickSites_theme_footer'], input:radio[name='quickSites_layout']").change(updateThemePreview);
  window.setTimeout(updateThemePreview, 10);
});
