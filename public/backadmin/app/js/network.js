/** 
 * Need Axios.min.js for load this function
 */

/**
 * Get Method
 * 
 * @param {String} url 
 * @param {Map} params  
 * @param {Function} callback
 * @returns 
 */

async function get(url, params = [], callback = null) {
    var response = axios.get(url, {
        params: params
    })
        .then(function (response) {

            return response;
        })
        .catch(function (error) {

            return error.response;
        })

    return response
}

/**
 * Post Method
 * 
 * @param {String} url 
 * @param {Map} data  
 * @param {Function} callback
 * @returns 
 */

async function post(url, data, callback = null) {
    var response = axios.post(url, data)
        .then(function (response) {

            return response;
        })
        .catch(function (error) {

            return error.response;
        })
    return response
}

/**
 * Put Method
 * 
 * @param {String} url 
 * @param {Map} data
 * @param {Function} callback
 * @returns 
 */

async function put(url, data, callback = null) {
    var response = axios.put(url, data)
        .then(function (response) {

            return response;
        })
        .catch(function (error) {

            return error.response;
        })

    return response
}

/**
 * Delete Method
 * 
 * @param {String} url
 * @param {Function} callback
 * @returns 
 */

async function destroy(url, callback = null) {
    var response = axios.delete(url)
        .then(function (response) {

            return response;
        })
        .catch(function (error) {

            return error.response;
        })

    return response
}