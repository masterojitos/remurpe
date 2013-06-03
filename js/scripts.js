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
    
    var provincias = $('#variables').data('provincias');
    var distritos = $('#variables').data('distritos');
    
    var options_provincias, provincia_index, provincia_value;
    $('#departamento').on('change', function() {
        options_provincias = new Array();
        $('#provincia option:gt(0), #distrito option:gt(0)').remove();
        $this = $(this).val();
        if ($this === '') {
            $('#provincia, #distrito').attr("disabled", "disabled");
            return;
        }
        $('#distrito').attr("disabled", "disabled");
        for (provincia_index in provincias[$this]) {
            provincia_value = provincias[$this][provincia_index];
            options_provincias.push($('<option />', { value: provincia_value, text: provincia_value }));
        }
        $('#provincia').append(options_provincias).removeAttr('disabled');
    });
    
    var options_distritos, distrito_index, distrito_value;
    $('#provincia').on('change', function() {
        options_distritos = new Array();
        $('#distrito option:gt(0)').remove();
        $this = $(this).val();
        if ($this === '') {
            $('#distrito').attr("disabled", "disabled");
            return;
        }
        for (distrito_index in distritos[$('#departamento').val()][$this]) {
            distrito_value = distritos[$('#departamento').val()][$this][distrito_index];
            options_distritos.push($('<option />', { value: distrito_value, text: distrito_value }));
        }
        $('#distrito').append(options_distritos).removeAttr('disabled');
    });

    $("form").on("submit", function(e) {
        e.preventDefault();
        $this = $(this);
        $("html").animate({scrollTop : 0}, 500);
    });
});