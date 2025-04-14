function loadTemplate(templateId, filePath, callback) {
    fetch(filePath)
        .then(response => response.text())
        .then(data => {
            document.getElementById(templateId).innerHTML = data;
            if (callback) callback();
        })
        .catch(error => console.error('Error al cargar la plantilla:', error));
  }
  
  loadTemplate('header-placeholder', '../../../FootNav/header.html', function() {
    const servicios = document.querySelector('.servicios');
    const submenu = document.querySelector('.submenu'); 
    if (servicios) { 
        servicios.addEventListener('click', () => {
            const submenu = document.querySelector('.submenu');
            submenu.classList.toggle('active');
        });
        
    }
  
    document.addEventListener('click', function(event) {
        if (!servicios.contains(event.target) && !submenu.contains(event.target)) {
            submenu.classList.remove('active');
        }
    });
  });
  
  loadTemplate('footer-placeholder', '../../../FootNav/footer.html');
  
  
  document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const servicesSubmenu = document.getElementById('services-submenu');
  
    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        servicesSubmenu.classList.toggle('active');
    });
  
    // Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        if (!menuToggle.contains(event.target) && !servicesSubmenu.contains(event.target)) {
            servicesSubmenu.classList.remove('active');
        }
    });
  
    // Prevenir que los clics dentro del menú lo cierren
    servicesSubmenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
  });



// Función para cargar el contenido de la plantilla de los géneros

  document.addEventListener('DOMContentLoaded', () => {
    const genreLinks = document.querySelectorAll('.genre-link');
    genreLinks.forEach(link => {
      link.addEventListener('click', (event) => {
        event.preventDefault(); // Evita la navegación inmediata
        const genreId = link.parentElement.getAttribute('data-genre-id');
        const href = link.getAttribute('href');
        // Redirigir con el genre_id como parámetro en la URL
        window.location.href = `${href}?genre_id=${genreId}`;
      });
    });
  });

// Función para cargar el contenido de la plantilla de los géneros
  async function includeHTML() {
    const elements = document.querySelectorAll('[include-html]');
    for (let el of elements) {
      const file = el.getAttribute('include-html');
      try {
        const response = await fetch(file);
        if (response.ok) {
          el.innerHTML = await response.text();
          if (file.includes("header.html")) {
            const script = document.createElement("script");
            script.src = "/rutinas-de-ejercicios/includes/Header/script.js";
            document.body.appendChild(script);
          }
        } else {
          el.innerHTML = "<p>Error al cargar el contenido.</p>";
        }
      } catch (error) {
        el.innerHTML = "<p>Error de conexión al cargar el contenido.</p>";
      }
    }
  }
  document.addEventListener("DOMContentLoaded", includeHTML);
