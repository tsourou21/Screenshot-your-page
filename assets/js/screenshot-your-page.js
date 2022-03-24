document.querySelector('.scrshot-btn').addEventListener('click', function() {
    let element = document.getElementById('body');
        const options = {
          letterRendering: true
        };

        html2canvas(element, options).then(function(canvas) {      
        document.body.appendChild(canvas);

        const link = document.createElement('a');
        link.download = 'screenshot.png';
        link.href = canvas.toDataURL();
        link.click();
    });
}); 