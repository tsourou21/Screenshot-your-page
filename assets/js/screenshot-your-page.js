let btns = document.getElementsByClassName('scrshot-btn');

for (let i=0; i < btns.length; i++) {
    btns[i].addEventListener('click', function() {
        let adminBar = document.getElementById('wpadminbar');
        if(adminBar){
            document.getElementById('wpadminbar').style.display = 'none';
            let element = document.getElementsByTagName('body')[0];
                const options = {
                    letterRendering: true
                };
        
                html2canvas(element, options).then(function(canvas) {      
        
                const link = document.createElement('a');
                link.download = 'scan-and-save.png';
                link.href = canvas.toDataURL();
                link.click();
            });
            document.getElementById('wpadminbar').style.display = 'block';  
        }else{
            let element = document.getElementsByTagName('body')[0];
                const options = {
                    letterRendering: true
                };
        
                html2canvas(element, options).then(function(canvas) {      
        
                const link = document.createElement('a');
                link.download = 'scan-and-save.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
        
    }); 
}
