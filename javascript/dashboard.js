var divToPrint = document.getElementById('print');
newWin = window.open("");
newWin.document.write(divToPrint.outerHTML);
newWin.print();
newWin.close();