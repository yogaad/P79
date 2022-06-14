/* Init select2  */
function initS2FieldWithAjax(elId, route, data, attrs, callback) {
    $.ajax({
        type: 'GET',
        url: route,
        data: data
    }).then(function (res) {

        let optText = '';
        attrs.forEach((item, i) => {
            if (i != 0) {
                optText += ' - ';
            }
            optText += res[item];
        });
        let option = new Option(optText, res.id, true, true);
        $(elId).append(option).trigger('change');
        if (callback) {
            callback(res);
        }
    });
}

/**
 * Initialize select2 field without AJAX call
 * 
 * @param {String} selector 
 * @param {Object} data 
 * @param {Array} attrs 
 * @param {Function} callback 
 */
function initS2Field(selector, data, attrs, callback) {
    
    let optText = '';
    attrs.forEach((item, i) => {
        if ( i != 0 ) {
            optText += ' - ';
        }
        optText += data[item];
    });

    let option = new Option(optText, data.id, true, true);
    $(selector).append(option).trigger('change');

    if (callback) {
        callback(data)
    }
}

/*
    Generate options and select null value
*/
function generateOptions(selector, placeholder, data, attrs, delimiter) {
    let field = $(selector);// console.log(selector, placeholder, data, attrs, delimiter);
    field.empty();
    field.append(new Option(placeholder, '', true, true));
    field.find('option').prop('disabled', true);

    data.forEach((element, index) => {
        let optText = '';
        attrs.forEach((item, i) => {
            if ( i != 0 ) {
                optText += delimiter;
            }
            optText += element[item];
        });
        let option = new Option(optText, index, false, false);
        field.append(option);
    });
    field.val(null).trigger('change').prop('disabled', false);
}

/**
 * Get shipping
 */
function getShipping(selector, addresses, url, callback) {
    $(selector).off('change').on('change', function(e) {
        let address = addresses[this.value];
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                regency_id: address.id_regency
            },
            success: function(res) {
                if (res != null) {
                    if (callback) {
                        callback(res);
                    }
                }
            }
        })
    })
}

/**
 * Return formatted number
 * 
 * @param {int} val 
 * @returns 
 */
function numberFormat(val) {
    return new Intl.NumberFormat('id-ID').format(val);
}

/**
 * Convert formatted string to number
 * 
 * @param {String} val 
 * @returns 
 */
function parseNumber(val) {
    let text = parseFloat(val.replace(/[^0-9$,]/g, '').replace(',','.'));
    return (isNaN(text)) ? 0 : text;
}

/**
 * 
 * @param {String} history 
 * @param {String} status 
 * @returns 
 */
function getHistoryByStatus(history, status) {
    let obj = history.find(el => (el.status == status))
    if (obj) {
        return obj.date;
    } else {
        return '-';
    }
}

function dateConvert(date) {
    return moment(date).format("DD/MM/YYYY");
}

function dateTimeConvert(date) {
    return moment(date).format("DD/MM/YYYY HH:mm");
}

function convertDateString(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('id', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    }).format(date);
}