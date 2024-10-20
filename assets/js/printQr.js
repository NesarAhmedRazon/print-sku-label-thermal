(function () {
    // on click of print button
    document.getElementById("printQr").addEventListener("click", function (e) {
      e.preventDefault();
      // male a ajax call to get the qr genarator
      let adminUrl = this.getAttribute("data-admin");
      let text = this.getAttribute("data-sku");
      let post_title = document.getElementById("title").value;
      let qrcontent = "";
      jQuery.ajax({
        type: "POST",
        url: adminUrl,
        data: {
          action: "getQrData",
          text: text
        },
        success: function (data) {
          qrcontent = data;
          // Create a new window with the HTML content
          var printWindow = window.open("", "_blank");
          // get the css url form data-css attribute
          let cssUrl = document
            .getElementById("printQr")
            .getAttribute("data-css");
  
          // create the content for the new window
          let content = `<html><head><title>Print QR</title>`;
          content += `<link href="${cssUrl}" rel="stylesheet"/><link rel="preconnect" href="https://fonts.googleapis.com">`;
          content += `<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>`;
          content += `<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100;300;400;500;700;800;900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">`;
          content += `</head><body><div class="qr-code-container">`;
          content += `<div class="qr-code">${qrcontent}</div>`;
          content += `<div class="qr-code-title"><span class="sku">${text}</span><br/>${post_title}</div>`;
          content += `</div></body></html>`;
  
          // write the content to the new window
          printWindow.document.open();
          printWindow.document.write(content);
          printWindow.document.close();
          // print the window
          // margies are set to none
          printWindow.document.body.style.margin = "0";
          printWindow.print();
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  })();
  