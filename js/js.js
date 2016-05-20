/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
     $(".datan").mask("99/99/9999");
    $('.cadcepc #texto').each(function () {
        $(this).removeAttr('required');
    });
    $('.resfinal2').click(function () {
        $('.resfinaldivvc').hide();
        $(this).parent().find('#resfinaldivv').show();
    });
    $('.candidatocur').click(function () {
        $('.modal-body').html($(this).parent().find('.dcandidatocur').html());
        $('.modal-title').html('Curriculum de '+$(this).parent().find('.candidatonome').html());
        $('#myModal').modal();
        return false;
    });
    $('.candidatojus').click(function () {
        $('.modal-body').html($(this).parent().find('.dcandidatojus').html());
        $('.modal-title').html('justificativa de '+$(this).parent().find('.candidatonome').html());
        $('#myModal').modal();
        return false;
    });
    $('.candidatopro').click(function () {
        $('.modal-body').html($(this).parent().find('.dcandidatopro').html());
        $('.modal-title').html('proposta de '+$(this).parent().find('.candidatonome').html());
        $('#myModal').modal();
        return false;
    });
    $('.usuario').click(function () {
        if ($(this).val() == '1') {
            $('.cadcepc').each(function () {
                $(this).show();
            });
            $('.cadcepcu').each(function () {
                $(this).hide();
            });
            $('.cadcepc #texto').each(function () {
                $(this).attr('required', 'true');
            });
            $('.cadcepcu #texto').each(function () {
                $(this).removeAttr('required');
            });

        } else {
            $('.cadcepc').each(function () {
                $(this).hide()
            });
            $('.cadcepcu').each(function () {
                $(this).show();
            });
            $('.cadcepc #texto').each(function () {
                $(this).removeAttr('required');
            });
            $('.cadcepcu #texto').each(function () {
                $(this).attr('required', 'true');
            });
        }
    });
    $('form').on('submit', function () {
        
        // do validation here
        if ($('#senha').val() != $('#csenha').val()) {
            alert('O campo Senha não esta igual o campo Confirmar senha');
            return false;
        }
    });
});