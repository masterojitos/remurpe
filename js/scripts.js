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
            options_provincias.push($('<option />', {value: provincia_value, text: provincia_value}));
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
            options_distritos.push($('<option />', {value: distrito_value, text: distrito_value}));
        }
        $('#distrito').append(options_distritos).removeAttr('disabled');
    });
    
    var checkbox_name, checkboxs_selector;
    var checkall_checked = false;
    $(".checkbox-checkall").on("click", function() {
        $this = $(this);
        checkbox_name = $("." + $this.data("trigger")).data("checkname");
        checkboxs_selector = "." + $this.data("trigger") + " input[type=checkbox][name^=" + checkbox_name + "]";
        $("." + $this.data("trigger") + " .checkall").prop("checked", ($(checkboxs_selector).length === $(checkboxs_selector + ":checked").length));
        if (($(checkboxs_selector).length === $(checkboxs_selector + ":checked").length)) {
            $("." + $this.data("trigger") + " .checkall").toggleClass("on");
            checkall_checked = false;
        } else if ($("." + $this.data("trigger") + " .checkall").not(":checked") && !checkall_checked) {
            $("." + $this.data("trigger") + " .checkall").toggleClass("on");
            checkall_checked = true;
        }
    });
    $(document).on("click", ".checkall", function() {
        $this = $(this);
        checkbox_name = $("." + $this.data("trigger")).data("checkname");
        $("." + $this.data("trigger") + " input[type=checkbox][name^=" + checkbox_name + "]").prop("checked", $this.is(":checked")).parent().toggleClass("on");
    });
    
    
    //checkbox and radio styles
    $("label.checkbox span").on("click", function() {
        $(this).parent().toggleClass("on");
    });
    $("label.checkbox").on("click", function() {
        $(this).toggleClass("on");
    });
    $("label.radio").on("click", function() {
        $("label.radio").removeClass("on");
        $(this).addClass("on");
    });

    $("form").on("submit", function() {
        if ($('#condiciones_no').is(":checked")) {
            $("html").animate({scrollTop : $('#condiciones_no').parent().parent().position().top}, 500);
            return false;
        }
        return true;
    });
});