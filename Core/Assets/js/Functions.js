class Functions {

  /**
   * Limit string length
   * @param {string} item 
   * @param {int} limit 
   * @returns 
   */
  limitString(item, limit) {
    if (limit && item.length > limit) {
      return item.substring(0, limit) + "...";
    } else {
      return item;
    }
  }

  /**
   * 
   * @param {object} color 
   * @param {string} item 
   * @return string radio-btn-color
   */
  getRadioColor(color, item) {
    if (color) {
      return color[item];
    } else {
      return 'light';
    }
  }

  /**
   * Set component param(data)
   * @param {Object} componentObject 
   * @param {string} param 
   */
  setComponentParam(componentObject, param) {
    if (
      typeof componentObject.params[param] != "undefined" 
      && componentObject.params[param] != "" 
    ) {
      componentObject[param] = componentObject.params[param];
    } else {
      componentObject[param] = "";
    }
    
  }

  /**
   * Set all this.params data into vue variables
   * @param {Object} componentObject 
   */
  setComponentParams(componentObject) {
    Object.keys(componentObject['params']).forEach((param) => {
      this.setComponentParam(componentObject, param);
    })
    
    // If fileDir is unset set as table name
    if (componentObject['fileDir'] == "") {
      componentObject['fileDir'] = componentObject.params['tableName'];
    }
  }

  /**
   * Axios get request
   * @param {string} action 
   * @param {object} params 
   * @param {function} success 
   */
  axiosGet(action = "", params = {}, success) {
    if(action == "") throw new Error("Unknown axiosGet action");

    axios.get('index.php?action=' + action, {
      params
    }).then((res) => {
      if (typeof success == "function") {
        success(res);
      }
    })
  }

  /**
   * window.open action
   * @param {string} action 
   * @param {object} params 
   */
  windowOpen(action = "", params = {}) {
    if(action == "") throw new Error("Unknown windowOpen action");

    var paramsQuery = "";

    if (Object.keys(params).length > 0) {
      Object.keys(params).forEach((param) => {
        paramsQuery += "&" + param + "=" + params[param];
      })

      action += paramsQuery;
    }

    window.open("index.php?action=" + action);
  }

}