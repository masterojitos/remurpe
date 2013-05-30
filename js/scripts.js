$(document).on("ready", function() {
    var $this;
    
    var moFile = function(e) {
        e.preventDefault();
        $(".mo_file_trigger[name='" + $(this).data("filename") + "']").trigger("click");
    };
    $('.mo_file').on("click", moFile);
    $('.mo_file').next().on("click", moFile);
    $('.mo_file_trigger').on("change", function() {
        $('.mo_file[id="' + this.name + '"]').val(this.value);
    });

    $("form").on("submit", function(e) {
        e.preventDefault();
        $this = $(this);
        $("html").animate({scrollTop : 0}, 500);
    });
});