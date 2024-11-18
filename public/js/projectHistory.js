//Metodo Ajax


$(document).ready(function () {
  var projectTable = $("#historyTable").DataTable({
    ajax: {
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      data: { action: "printTable" },
    },
    columnDefs: [
      { visible: false, targets: 1 },
      { visible: false, targets: 4 },
      {
        targets: 3,
        orderData: [3],
        render: function (data, type, row) {
          var completedOrder = {
            'Create': 1,
            'Edit': 2,
            'Delete': 3,
          };
          return type === 'sort' ? completedOrder[data] : data;
        }
      },
    ],
    columns: [
      { data: "id" },
      { data: "projectId" },
      { data: "projectName" },
      { data: "action" },
      { data: "userId" },
      { data: "userName" },
      { data: "timestamp" },
    ],
  });



  // Ordenar por fecha
  $("#orderDate").on("change", function () {
    projectTable.order([6, this.value]).draw();
  });
});
