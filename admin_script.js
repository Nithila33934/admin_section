
     // single-active selection in left side bar
        document.querySelectorAll('.toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
               document.querySelectorAll('.toggle').forEach(t => t.classList.remove('on'));   // Find all toggles and turn them OFF     
                 this.classList.add('on'); // Turn the clicked toggle ON
    });
});
        // Menu item selection
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

      
        const form = document.getElementById('registration-form');
       const message = document.getElementById('success-message');

    if (form && message) {
    form.addEventListener('submit', async function(event) {
        event.preventDefault(); // Prevent the default form submission


        let formData = new FormData(form);

        let response = await fetch('user_insert.php', {
            method: "POST",
            body: formData
        });

        let result = await response.json();

        if (result.success) {
            message.style.display = 'block';
            form.reset();

            setTimeout(() => {
                message.style.display = 'none';
            }, 4000);
        } else {
            alert(result.error.join('\n'));
        }
    });
}
        


        
    
