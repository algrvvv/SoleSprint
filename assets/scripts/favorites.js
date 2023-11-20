
var clickTimes = 0;

function add(id, condition) {
    clickTimes++;
    if (condition == 'false') {
        if (clickTimes % 2 == 0) {
            const svgElement = document.getElementById(id);
            svgElement.style.fill = 'none';
            $.ajax({
                url: '/app/Ajax/favorite.php',
                data: {
                    status: 'false',
                    id_product: id,
                    condition: 'false'
                },
                success: function (data) {
                    $('.test').html(data);
                }
            });
        } else {
            const svgElement = document.getElementById(id);
            svgElement.style.fill = 'red';
            $.ajax({
                url: '/App/Ajax/favorite.php',
                data: {
                    status: 'true',
                    id_product: id,
                    condition: 'true'
                },
                success: function (data) {
                    $('.test').html(data);
                }
            });
        }
    } else {
        if (clickTimes % 2 == 0) {
            const svgElement = document.getElementById(id);
            svgElement.style.fill = 'red';
            $.ajax({
                url: '/app/Ajax/favorite.php',
                data: {
                    status: 'true',
                    id_product: id,
                    condition: 'true'
                },
                success: function (data) {
                    $('.test').html(data);
                }
            });
        } else {
            const svgElement = document.getElementById(id);
            svgElement.style.fill = 'none';
            $.ajax({
                url: '/App/Ajax/favorite.php',
                data: {
                    status: 'false',
                    id_product: id,
                    condition: 'false'
                },
                success: function (data) {
                    if(data != null) $('.test').html(data);
                }
            });
        }
    }

}
