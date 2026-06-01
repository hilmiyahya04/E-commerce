document.addEventListener('DOMContentLoaded', () => {

    // BUTTON PLUS
    document.querySelectorAll('.btn-qty-increase').forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const price = parseInt(this.dataset.price);

            const qtyElement = document.getElementById(`qty-${id}`);
            const priceElement = document.getElementById(`price-${id}`);

            let qty = parseInt(qtyElement.innerText);

            qty++;

            qtyElement.innerText = qty;

            const total = qty * price;

            priceElement.innerText = total.toLocaleString('id-ID');

        });

    });

    // BUTTON MINUS
    document.querySelectorAll('.btn-qty-decrease').forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const price = parseInt(this.dataset.price);

            const qtyElement = document.getElementById(`qty-${id}`);
            const priceElement = document.getElementById(`price-${id}`);

            let qty = parseInt(qtyElement.innerText);

            if (qty > 1) {

                qty--;

                qtyElement.innerText = qty;

                const total = qty * price;

                priceElement.innerText = total.toLocaleString('id-ID');

            }

        });

    });

});