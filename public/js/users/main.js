$(document).ready(function() {
    //Monta o dataTable de usuários
    var table = $('#users-datatable').DataTable({
     "oLanguage": {
         "sProcessing": "",
         "sLengthMenu": "Mostrar _MENU_ registros por pagina",
         "sZeroRecords": "Sem dados para exibir",
         "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
         "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
         "sInfoFiltered": "",
         "sSearch": "Procurar",
         "oPaginate": {
             "sFirst":    "Primeiro",
             "sPrevious": "Anterior",
             "sNext":     "Próximo",
             "sLast":     "Último"
         }
     },
     "processing": true,
     "pageLength" : 25,
     "serverSide": true,
     "ordering": false,
     "columnDefs": [ {
         "targets": 'no-sort',
         "orderable": false,
     } ],
     "order": [
         [0, "asc" ]
     ],
        "ajax": {
            url: "/users/datatable",
            type: 'GET',
            error: function (xhr, error, thrown) {
                if (xhr.status === 403) {
                    // A resposta foi uma view HTML. Podemos exibir, redirecionar ou substituir conteúdo da página
                    document.body.innerHTML = xhr.responseText;
                    // OU, se quiser redirecionar:
                    //window.location.href = '/sem-permissao';
                } else {
                    alert('Erro ao carregar os dados da tabela. Contate o administrador.');
                }
            }
        },
    });
});