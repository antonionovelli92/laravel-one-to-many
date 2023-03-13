
        // Prendo tutti i bottoni dal dom
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', e => {
                // Blocco l'evento
                e.preventDefault();
                const entity = form.getAttribute('data-entity') || 'Elemento';
                const hasConfirmed = confirm(`Sei sicuro di voler eliminare questo fantastico ${entity}?`);
                if (hasConfirmed) form.submit();
            });
        });
