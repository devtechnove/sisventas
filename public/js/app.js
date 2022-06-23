/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@iconify/iconify/dist/iconify.js":
/*!*******************************************************!*\
  !*** ./node_modules/@iconify/iconify/dist/iconify.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, exports) => {

/**
* (c) Iconify
*
* For the full copyright and license information, please view the license.txt or license.gpl.txt
* files at https://github.com/iconify/iconify
*
* Licensed under Apache 2.0 or GPL 2.0 at your option.
* If derivative product is not compatible with one of licenses, you can pick one of licenses.
*
* @license Apache 2.0
* @license GPL 2.0
* @version 2.2.1
*/
var Iconify = (function (exports) {
  'use strict';

  var matchName = /^[a-z0-9]+(-[a-z0-9]+)*$/;
  var iconDefaults = Object.freeze({
    left: 0,
    top: 0,
    width: 16,
    height: 16,
    rotate: 0,
    vFlip: false,
    hFlip: false
  });
  function fullIcon(data) {
    return Object.assign({}, iconDefaults, data);
  }

  function mergeIconData(icon, alias) {
    var result = Object.assign({}, icon);
    for (var key in iconDefaults) {
      var prop = key;
      if (alias[prop] !== void 0) {
        var value = alias[prop];
        if (result[prop] === void 0) {
          result[prop] = value;
          continue;
        }
        switch (prop) {
          case "rotate":
            result[prop] = (result[prop] + value) % 4;
            break;
          case "hFlip":
          case "vFlip":
            result[prop] = value !== result[prop];
            break;
          default:
            result[prop] = value;
        }
      }
    }
    return result;
  }

  function getIconData$1(data, name, full) {
    if ( full === void 0 ) full = false;

    function getIcon(name2, iteration) {
      if (data.icons[name2] !== void 0) {
        return Object.assign({}, data.icons[name2]);
      }
      if (iteration > 5) {
        return null;
      }
      var aliases = data.aliases;
      if (aliases && aliases[name2] !== void 0) {
        var item = aliases[name2];
        var result2 = getIcon(item.parent, iteration + 1);
        if (result2) {
          return mergeIconData(result2, item);
        }
        return result2;
      }
      var chars = data.chars;
      if (!iteration && chars && chars[name2] !== void 0) {
        return getIcon(chars[name2], iteration + 1);
      }
      return null;
    }
    var result = getIcon(name, 0);
    if (result) {
      for (var key in iconDefaults) {
        if (result[key] === void 0 && data[key] !== void 0) {
          result[key] = data[key];
        }
      }
    }
    return result && full ? fullIcon(result) : result;
  }

  function isVariation(item) {
    for (var key in iconDefaults) {
      if (item[key] !== void 0) {
        return true;
      }
    }
    return false;
  }
  function parseIconSet(data, callback, options) {
    options = options || {};
    var names = [];
    if (typeof data !== "object" || typeof data.icons !== "object") {
      return names;
    }
    if (data.not_found instanceof Array) {
      data.not_found.forEach(function (name) {
        callback(name, null);
        names.push(name);
      });
    }
    var icons = data.icons;
    Object.keys(icons).forEach(function (name) {
      var iconData = getIconData$1(data, name, true);
      if (iconData) {
        callback(name, iconData);
        names.push(name);
      }
    });
    var parseAliases = options.aliases || "all";
    if (parseAliases !== "none" && typeof data.aliases === "object") {
      var aliases = data.aliases;
      Object.keys(aliases).forEach(function (name) {
        if (parseAliases === "variations" && isVariation(aliases[name])) {
          return;
        }
        var iconData = getIconData$1(data, name, true);
        if (iconData) {
          callback(name, iconData);
          names.push(name);
        }
      });
    }
    return names;
  }

  var optionalProperties = {
    provider: "string",
    aliases: "object",
    not_found: "object"
  };
  for (var prop in iconDefaults) {
    optionalProperties[prop] = typeof iconDefaults[prop];
  }
  function quicklyValidateIconSet(obj) {
    if (typeof obj !== "object" || obj === null) {
      return null;
    }
    var data = obj;
    if (typeof data.prefix !== "string" || !obj.icons || typeof obj.icons !== "object") {
      return null;
    }
    for (var prop in optionalProperties) {
      if (obj[prop] !== void 0 && typeof obj[prop] !== optionalProperties[prop]) {
        return null;
      }
    }
    var icons = data.icons;
    for (var name in icons) {
      var icon = icons[name];
      if (!name.match(matchName) || typeof icon.body !== "string") {
        return null;
      }
      for (var prop$1 in iconDefaults) {
        if (icon[prop$1] !== void 0 && typeof icon[prop$1] !== typeof iconDefaults[prop$1]) {
          return null;
        }
      }
    }
    var aliases = data.aliases;
    if (aliases) {
      for (var name$1 in aliases) {
        var icon$1 = aliases[name$1];
        var parent = icon$1.parent;
        if (!name$1.match(matchName) || typeof parent !== "string" || !icons[parent] && !aliases[parent]) {
          return null;
        }
        for (var prop$2 in iconDefaults) {
          if (icon$1[prop$2] !== void 0 && typeof icon$1[prop$2] !== typeof iconDefaults[prop$2]) {
            return null;
          }
        }
      }
    }
    return data;
  }

  var stringToIcon = function (value, validate, allowSimpleName, provider) {
    if ( provider === void 0 ) provider = "";

    var colonSeparated = value.split(":");
    if (value.slice(0, 1) === "@") {
      if (colonSeparated.length < 2 || colonSeparated.length > 3) {
        return null;
      }
      provider = colonSeparated.shift().slice(1);
    }
    if (colonSeparated.length > 3 || !colonSeparated.length) {
      return null;
    }
    if (colonSeparated.length > 1) {
      var name2 = colonSeparated.pop();
      var prefix = colonSeparated.pop();
      var result = {
        provider: colonSeparated.length > 0 ? colonSeparated[0] : provider,
        prefix: prefix,
        name: name2
      };
      return validate && !validateIcon(result) ? null : result;
    }
    var name = colonSeparated[0];
    var dashSeparated = name.split("-");
    if (dashSeparated.length > 1) {
      var result$1 = {
        provider: provider,
        prefix: dashSeparated.shift(),
        name: dashSeparated.join("-")
      };
      return validate && !validateIcon(result$1) ? null : result$1;
    }
    if (allowSimpleName && provider === "") {
      var result$2 = {
        provider: provider,
        prefix: "",
        name: name
      };
      return validate && !validateIcon(result$2, allowSimpleName) ? null : result$2;
    }
    return null;
  };
  var validateIcon = function (icon, allowSimpleName) {
    if (!icon) {
      return false;
    }
    return !!((icon.provider === "" || icon.provider.match(matchName)) && (allowSimpleName && icon.prefix === "" || icon.prefix.match(matchName)) && icon.name.match(matchName));
  };

  var storageVersion = 1;
  var storage$1 = /* @__PURE__ */ Object.create(null);
  try {
    var w = window || self;
    if (w && w._iconifyStorage.version === storageVersion) {
      storage$1 = w._iconifyStorage.storage;
    }
  } catch (err) {
  }
  function shareStorage() {
    try {
      var w = window || self;
      if (w && !w._iconifyStorage) {
        w._iconifyStorage = {
          version: storageVersion,
          storage: storage$1
        };
      }
    } catch (err) {
    }
  }
  function newStorage(provider, prefix) {
    return {
      provider: provider,
      prefix: prefix,
      icons: /* @__PURE__ */ Object.create(null),
      missing: /* @__PURE__ */ Object.create(null)
    };
  }
  function getStorage(provider, prefix) {
    if (storage$1[provider] === void 0) {
      storage$1[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerStorage = storage$1[provider];
    if (providerStorage[prefix] === void 0) {
      providerStorage[prefix] = newStorage(provider, prefix);
    }
    return providerStorage[prefix];
  }
  function addIconSet(storage2, data) {
    if (!quicklyValidateIconSet(data)) {
      return [];
    }
    var t = Date.now();
    return parseIconSet(data, function (name, icon) {
      if (icon) {
        storage2.icons[name] = icon;
      } else {
        storage2.missing[name] = t;
      }
    });
  }
  function addIconToStorage(storage2, name, icon) {
    try {
      if (typeof icon.body === "string") {
        storage2.icons[name] = Object.freeze(fullIcon(icon));
        return true;
      }
    } catch (err) {
    }
    return false;
  }
  function getIconFromStorage(storage2, name) {
    var value = storage2.icons[name];
    return value === void 0 ? null : value;
  }
  function listIcons(provider, prefix) {
    var allIcons = [];
    var providers;
    if (typeof provider === "string") {
      providers = [provider];
    } else {
      providers = Object.keys(storage$1);
    }
    providers.forEach(function (provider2) {
      var prefixes;
      if (typeof provider2 === "string" && typeof prefix === "string") {
        prefixes = [prefix];
      } else {
        prefixes = storage$1[provider2] === void 0 ? [] : Object.keys(storage$1[provider2]);
      }
      prefixes.forEach(function (prefix2) {
        var storage2 = getStorage(provider2, prefix2);
        var icons = Object.keys(storage2.icons).map(function (name) { return (provider2 !== "" ? "@" + provider2 + ":" : "") + prefix2 + ":" + name; });
        allIcons = allIcons.concat(icons);
      });
    });
    return allIcons;
  }

  var simpleNames = false;
  function allowSimpleNames(allow) {
    if (typeof allow === "boolean") {
      simpleNames = allow;
    }
    return simpleNames;
  }
  function getIconData(name) {
    var icon = typeof name === "string" ? stringToIcon(name, true, simpleNames) : name;
    return icon ? getIconFromStorage(getStorage(icon.provider, icon.prefix), icon.name) : null;
  }
  function addIcon(name, data) {
    var icon = stringToIcon(name, true, simpleNames);
    if (!icon) {
      return false;
    }
    var storage = getStorage(icon.provider, icon.prefix);
    return addIconToStorage(storage, icon.name, data);
  }
  function addCollection(data, provider) {
    if (typeof data !== "object") {
      return false;
    }
    if (typeof provider !== "string") {
      provider = typeof data.provider === "string" ? data.provider : "";
    }
    if (simpleNames && provider === "" && (typeof data.prefix !== "string" || data.prefix === "")) {
      var added = false;
      if (quicklyValidateIconSet(data)) {
        data.prefix = "";
        parseIconSet(data, function (name, icon) {
          if (icon && addIcon(name, icon)) {
            added = true;
          }
        });
      }
      return added;
    }
    if (typeof data.prefix !== "string" || !validateIcon({
      provider: provider,
      prefix: data.prefix,
      name: "a"
    })) {
      return false;
    }
    var storage = getStorage(provider, data.prefix);
    return !!addIconSet(storage, data);
  }
  function iconExists(name) {
    return getIconData(name) !== null;
  }
  function getIcon(name) {
    var result = getIconData(name);
    return result ? Object.assign({}, result) : null;
  }

  var defaults = Object.freeze({
    inline: false,
    width: null,
    height: null,
    hAlign: "center",
    vAlign: "middle",
    slice: false,
    hFlip: false,
    vFlip: false,
    rotate: 0
  });
  function mergeCustomisations(defaults2, item) {
    var result = {};
    for (var key in defaults2) {
      var attr = key;
      result[attr] = defaults2[attr];
      if (item[attr] === void 0) {
        continue;
      }
      var value = item[attr];
      switch (attr) {
        case "inline":
        case "slice":
          if (typeof value === "boolean") {
            result[attr] = value;
          }
          break;
        case "hFlip":
        case "vFlip":
          if (value === true) {
            result[attr] = !result[attr];
          }
          break;
        case "hAlign":
        case "vAlign":
          if (typeof value === "string" && value !== "") {
            result[attr] = value;
          }
          break;
        case "width":
        case "height":
          if (typeof value === "string" && value !== "" || typeof value === "number" && value || value === null) {
            result[attr] = value;
          }
          break;
        case "rotate":
          if (typeof value === "number") {
            result[attr] += value;
          }
          break;
      }
    }
    return result;
  }

  var unitsSplit = /(-?[0-9.]*[0-9]+[0-9.]*)/g;
  var unitsTest = /^-?[0-9.]*[0-9]+[0-9.]*$/g;
  function calculateSize(size, ratio, precision) {
    if (ratio === 1) {
      return size;
    }
    precision = precision === void 0 ? 100 : precision;
    if (typeof size === "number") {
      return Math.ceil(size * ratio * precision) / precision;
    }
    if (typeof size !== "string") {
      return size;
    }
    var oldParts = size.split(unitsSplit);
    if (oldParts === null || !oldParts.length) {
      return size;
    }
    var newParts = [];
    var code = oldParts.shift();
    var isNumber = unitsTest.test(code);
    while (true) {
      if (isNumber) {
        var num = parseFloat(code);
        if (isNaN(num)) {
          newParts.push(code);
        } else {
          newParts.push(Math.ceil(num * ratio * precision) / precision);
        }
      } else {
        newParts.push(code);
      }
      code = oldParts.shift();
      if (code === void 0) {
        return newParts.join("");
      }
      isNumber = !isNumber;
    }
  }

  function preserveAspectRatio(props) {
    var result = "";
    switch (props.hAlign) {
      case "left":
        result += "xMin";
        break;
      case "right":
        result += "xMax";
        break;
      default:
        result += "xMid";
    }
    switch (props.vAlign) {
      case "top":
        result += "YMin";
        break;
      case "bottom":
        result += "YMax";
        break;
      default:
        result += "YMid";
    }
    result += props.slice ? " slice" : " meet";
    return result;
  }
  function iconToSVG(icon, customisations) {
    var box = {
      left: icon.left,
      top: icon.top,
      width: icon.width,
      height: icon.height
    };
    var body = icon.body;
    [icon, customisations].forEach(function (props) {
      var transformations = [];
      var hFlip = props.hFlip;
      var vFlip = props.vFlip;
      var rotation = props.rotate;
      if (hFlip) {
        if (vFlip) {
          rotation += 2;
        } else {
          transformations.push("translate(" + (box.width + box.left).toString() + " " + (0 - box.top).toString() + ")");
          transformations.push("scale(-1 1)");
          box.top = box.left = 0;
        }
      } else if (vFlip) {
        transformations.push("translate(" + (0 - box.left).toString() + " " + (box.height + box.top).toString() + ")");
        transformations.push("scale(1 -1)");
        box.top = box.left = 0;
      }
      var tempValue;
      if (rotation < 0) {
        rotation -= Math.floor(rotation / 4) * 4;
      }
      rotation = rotation % 4;
      switch (rotation) {
        case 1:
          tempValue = box.height / 2 + box.top;
          transformations.unshift("rotate(90 " + tempValue.toString() + " " + tempValue.toString() + ")");
          break;
        case 2:
          transformations.unshift("rotate(180 " + (box.width / 2 + box.left).toString() + " " + (box.height / 2 + box.top).toString() + ")");
          break;
        case 3:
          tempValue = box.width / 2 + box.left;
          transformations.unshift("rotate(-90 " + tempValue.toString() + " " + tempValue.toString() + ")");
          break;
      }
      if (rotation % 2 === 1) {
        if (box.left !== 0 || box.top !== 0) {
          tempValue = box.left;
          box.left = box.top;
          box.top = tempValue;
        }
        if (box.width !== box.height) {
          tempValue = box.width;
          box.width = box.height;
          box.height = tempValue;
        }
      }
      if (transformations.length) {
        body = '<g transform="' + transformations.join(" ") + '">' + body + "</g>";
      }
    });
    var width, height;
    if (customisations.width === null && customisations.height === null) {
      height = "1em";
      width = calculateSize(height, box.width / box.height);
    } else if (customisations.width !== null && customisations.height !== null) {
      width = customisations.width;
      height = customisations.height;
    } else if (customisations.height !== null) {
      height = customisations.height;
      width = calculateSize(height, box.width / box.height);
    } else {
      width = customisations.width;
      height = calculateSize(width, box.height / box.width);
    }
    if (width === "auto") {
      width = box.width;
    }
    if (height === "auto") {
      height = box.height;
    }
    width = typeof width === "string" ? width : width.toString() + "";
    height = typeof height === "string" ? height : height.toString() + "";
    var result = {
      attributes: {
        width: width,
        height: height,
        preserveAspectRatio: preserveAspectRatio(customisations),
        viewBox: box.left.toString() + " " + box.top.toString() + " " + box.width.toString() + " " + box.height.toString()
      },
      body: body
    };
    if (customisations.inline) {
      result.inline = true;
    }
    return result;
  }

  function buildIcon(icon, customisations) {
    return iconToSVG(fullIcon(icon), customisations ? mergeCustomisations(defaults, customisations) : defaults);
  }

  var regex = /\sid="(\S+)"/g;
  var randomPrefix = "IconifyId" + Date.now().toString(16) + (Math.random() * 16777216 | 0).toString(16);
  var counter = 0;
  function replaceIDs(body, prefix) {
    if ( prefix === void 0 ) prefix = randomPrefix;

    var ids = [];
    var match;
    while (match = regex.exec(body)) {
      ids.push(match[1]);
    }
    if (!ids.length) {
      return body;
    }
    ids.forEach(function (id) {
      var newID = typeof prefix === "function" ? prefix(id) : prefix + (counter++).toString();
      var escapedID = id.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
      body = body.replace(new RegExp('([#;"])(' + escapedID + ')([")]|\\.[a-z])', "g"), "$1" + newID + "$3");
    });
    return body;
  }

  var cacheVersion = "iconify2";
  var cachePrefix = "iconify";
  var countKey = cachePrefix + "-count";
  var versionKey = cachePrefix + "-version";
  var hour = 36e5;
  var cacheExpiration = 168;
  var config = {
    local: true,
    session: true
  };
  var loaded = false;
  var count = {
    local: 0,
    session: 0
  };
  var emptyList = {
    local: [],
    session: []
  };
  var _window$2 = typeof window === "undefined" ? {} : window;
  function getGlobal(key) {
    var attr = key + "Storage";
    try {
      if (_window$2 && _window$2[attr] && typeof _window$2[attr].length === "number") {
        return _window$2[attr];
      }
    } catch (err) {
    }
    config[key] = false;
    return null;
  }
  function setCount(storage, key, value) {
    try {
      storage.setItem(countKey, value.toString());
      count[key] = value;
      return true;
    } catch (err) {
      return false;
    }
  }
  function getCount(storage) {
    var count2 = storage.getItem(countKey);
    if (count2) {
      var total = parseInt(count2);
      return total ? total : 0;
    }
    return 0;
  }
  function initCache(storage, key) {
    try {
      storage.setItem(versionKey, cacheVersion);
    } catch (err) {
    }
    setCount(storage, key, 0);
  }
  function destroyCache(storage) {
    try {
      var total = getCount(storage);
      for (var i = 0; i < total; i++) {
        storage.removeItem(cachePrefix + i.toString());
      }
    } catch (err) {
    }
  }
  var loadCache = function () {
    if (loaded) {
      return;
    }
    loaded = true;
    var minTime = Math.floor(Date.now() / hour) - cacheExpiration;
    function load(key) {
      var func = getGlobal(key);
      if (!func) {
        return;
      }
      var getItem = function (index) {
        var name = cachePrefix + index.toString();
        var item = func.getItem(name);
        if (typeof item !== "string") {
          return false;
        }
        var valid = true;
        try {
          var data = JSON.parse(item);
          if (typeof data !== "object" || typeof data.cached !== "number" || data.cached < minTime || typeof data.provider !== "string" || typeof data.data !== "object" || typeof data.data.prefix !== "string") {
            valid = false;
          } else {
            var provider = data.provider;
            var prefix = data.data.prefix;
            var storage = getStorage(provider, prefix);
            valid = addIconSet(storage, data.data).length > 0;
          }
        } catch (err) {
          valid = false;
        }
        if (!valid) {
          func.removeItem(name);
        }
        return valid;
      };
      try {
        var version = func.getItem(versionKey);
        if (version !== cacheVersion) {
          if (version) {
            destroyCache(func);
          }
          initCache(func, key);
          return;
        }
        var total = getCount(func);
        for (var i = total - 1; i >= 0; i--) {
          if (!getItem(i)) {
            if (i === total - 1) {
              total--;
            } else {
              emptyList[key].push(i);
            }
          }
        }
        setCount(func, key, total);
      } catch (err) {
      }
    }
    for (var key in config) {
      load(key);
    }
  };
  var storeCache = function (provider, data) {
    if (!loaded) {
      loadCache();
    }
    function store(key) {
      if (!config[key]) {
        return false;
      }
      var func = getGlobal(key);
      if (!func) {
        return false;
      }
      var index = emptyList[key].shift();
      if (index === void 0) {
        index = count[key];
        if (!setCount(func, key, index + 1)) {
          return false;
        }
      }
      try {
        var item = {
          cached: Math.floor(Date.now() / hour),
          provider: provider,
          data: data
        };
        func.setItem(cachePrefix + index.toString(), JSON.stringify(item));
      } catch (err) {
        return false;
      }
      return true;
    }
    if (!Object.keys(data.icons).length) {
      return;
    }
    if (data.not_found) {
      data = Object.assign({}, data);
      delete data.not_found;
    }
    if (!store("local")) {
      store("session");
    }
  };

  var cache = {};

  function toggleBrowserCache(storage, value) {
    switch (storage) {
      case "local":
      case "session":
        config[storage] = value;
        break;
      case "all":
        for (var key in config) {
          config[key] = value;
        }
        break;
    }
  }

  var storage = /* @__PURE__ */ Object.create(null);
  function setAPIModule(provider, item) {
    storage[provider] = item;
  }
  function getAPIModule(provider) {
    return storage[provider] || storage[""];
  }

  function createAPIConfig(source) {
    var resources;
    if (typeof source.resources === "string") {
      resources = [source.resources];
    } else {
      resources = source.resources;
      if (!(resources instanceof Array) || !resources.length) {
        return null;
      }
    }
    var result = {
      resources: resources,
      path: source.path === void 0 ? "/" : source.path,
      maxURL: source.maxURL ? source.maxURL : 500,
      rotate: source.rotate ? source.rotate : 750,
      timeout: source.timeout ? source.timeout : 5e3,
      random: source.random === true,
      index: source.index ? source.index : 0,
      dataAfterTimeout: source.dataAfterTimeout !== false
    };
    return result;
  }
  var configStorage = /* @__PURE__ */ Object.create(null);
  var fallBackAPISources = [
    "https://api.simplesvg.com",
    "https://api.unisvg.com"
  ];
  var fallBackAPI = [];
  while (fallBackAPISources.length > 0) {
    if (fallBackAPISources.length === 1) {
      fallBackAPI.push(fallBackAPISources.shift());
    } else {
      if (Math.random() > 0.5) {
        fallBackAPI.push(fallBackAPISources.shift());
      } else {
        fallBackAPI.push(fallBackAPISources.pop());
      }
    }
  }
  configStorage[""] = createAPIConfig({
    resources: ["https://api.iconify.design"].concat(fallBackAPI)
  });
  function addAPIProvider(provider, customConfig) {
    var config = createAPIConfig(customConfig);
    if (config === null) {
      return false;
    }
    configStorage[provider] = config;
    return true;
  }
  function getAPIConfig(provider) {
    return configStorage[provider];
  }
  function listAPIProviders() {
    return Object.keys(configStorage);
  }

  var mergeParams = function (base, params) {
    var result = base, hasParams = result.indexOf("?") !== -1;
    function paramToString(value) {
      switch (typeof value) {
        case "boolean":
          return value ? "true" : "false";
        case "number":
          return encodeURIComponent(value);
        case "string":
          return encodeURIComponent(value);
        default:
          throw new Error("Invalid parameter");
      }
    }
    Object.keys(params).forEach(function (key) {
      var value;
      try {
        value = paramToString(params[key]);
      } catch (err) {
        return;
      }
      result += (hasParams ? "&" : "?") + encodeURIComponent(key) + "=" + value;
      hasParams = true;
    });
    return result;
  };

  var maxLengthCache = {};
  var pathCache = {};
  var detectFetch = function () {
    var callback;
    try {
      callback = fetch;
      if (typeof callback === "function") {
        return callback;
      }
    } catch (err) {
    }
    return null;
  };
  var fetchModule = detectFetch();
  function setFetch(fetch2) {
    fetchModule = fetch2;
  }
  function getFetch() {
    return fetchModule;
  }
  function calculateMaxLength(provider, prefix) {
    var config = getAPIConfig(provider);
    if (!config) {
      return 0;
    }
    var result;
    if (!config.maxURL) {
      result = 0;
    } else {
      var maxHostLength = 0;
      config.resources.forEach(function (item) {
        var host = item;
        maxHostLength = Math.max(maxHostLength, host.length);
      });
      var url = mergeParams(prefix + ".json", {
        icons: ""
      });
      result = config.maxURL - maxHostLength - config.path.length - url.length;
    }
    var cacheKey = provider + ":" + prefix;
    pathCache[provider] = config.path;
    maxLengthCache[cacheKey] = result;
    return result;
  }
  function shouldAbort(status) {
    return status === 404;
  }
  var prepare = function (provider, prefix, icons) {
    var results = [];
    var maxLength = maxLengthCache[prefix];
    if (maxLength === void 0) {
      maxLength = calculateMaxLength(provider, prefix);
    }
    var type = "icons";
    var item = {
      type: type,
      provider: provider,
      prefix: prefix,
      icons: []
    };
    var length = 0;
    icons.forEach(function (name, index) {
      length += name.length + 1;
      if (length >= maxLength && index > 0) {
        results.push(item);
        item = {
          type: type,
          provider: provider,
          prefix: prefix,
          icons: []
        };
        length = name.length;
      }
      item.icons.push(name);
    });
    results.push(item);
    return results;
  };
  function getPath(provider) {
    if (typeof provider === "string") {
      if (pathCache[provider] === void 0) {
        var config = getAPIConfig(provider);
        if (!config) {
          return "/";
        }
        pathCache[provider] = config.path;
      }
      return pathCache[provider];
    }
    return "/";
  }
  var send = function (host, params, callback) {
    if (!fetchModule) {
      callback("abort", 424);
      return;
    }
    var path = getPath(params.provider);
    switch (params.type) {
      case "icons": {
        var prefix = params.prefix;
        var icons = params.icons;
        var iconsList = icons.join(",");
        path += mergeParams(prefix + ".json", {
          icons: iconsList
        });
        break;
      }
      case "custom": {
        var uri = params.uri;
        path += uri.slice(0, 1) === "/" ? uri.slice(1) : uri;
        break;
      }
      default:
        callback("abort", 400);
        return;
    }
    var defaultError = 503;
    fetchModule(host + path).then(function (response) {
      var status = response.status;
      if (status !== 200) {
        setTimeout(function () {
          callback(shouldAbort(status) ? "abort" : "next", status);
        });
        return;
      }
      defaultError = 501;
      return response.json();
    }).then(function (data) {
      if (typeof data !== "object" || data === null) {
        setTimeout(function () {
          callback("next", defaultError);
        });
        return;
      }
      setTimeout(function () {
        callback("success", data);
      });
    }).catch(function () {
      callback("next", defaultError);
    });
  };
  var fetchAPIModule = {
    prepare: prepare,
    send: send
  };

  function sortIcons(icons) {
    var result = {
      loaded: [],
      missing: [],
      pending: []
    };
    var storage = /* @__PURE__ */ Object.create(null);
    icons.sort(function (a, b) {
      if (a.provider !== b.provider) {
        return a.provider.localeCompare(b.provider);
      }
      if (a.prefix !== b.prefix) {
        return a.prefix.localeCompare(b.prefix);
      }
      return a.name.localeCompare(b.name);
    });
    var lastIcon = {
      provider: "",
      prefix: "",
      name: ""
    };
    icons.forEach(function (icon) {
      if (lastIcon.name === icon.name && lastIcon.prefix === icon.prefix && lastIcon.provider === icon.provider) {
        return;
      }
      lastIcon = icon;
      var provider = icon.provider;
      var prefix = icon.prefix;
      var name = icon.name;
      if (storage[provider] === void 0) {
        storage[provider] = /* @__PURE__ */ Object.create(null);
      }
      var providerStorage = storage[provider];
      if (providerStorage[prefix] === void 0) {
        providerStorage[prefix] = getStorage(provider, prefix);
      }
      var localStorage = providerStorage[prefix];
      var list;
      if (localStorage.icons[name] !== void 0) {
        list = result.loaded;
      } else if (prefix === "" || localStorage.missing[name] !== void 0) {
        list = result.missing;
      } else {
        list = result.pending;
      }
      var item = {
        provider: provider,
        prefix: prefix,
        name: name
      };
      list.push(item);
    });
    return result;
  }

  var callbacks = /* @__PURE__ */ Object.create(null);
  var pendingUpdates = /* @__PURE__ */ Object.create(null);
  function removeCallback(sources, id) {
    sources.forEach(function (source) {
      var provider = source.provider;
      if (callbacks[provider] === void 0) {
        return;
      }
      var providerCallbacks = callbacks[provider];
      var prefix = source.prefix;
      var items = providerCallbacks[prefix];
      if (items) {
        providerCallbacks[prefix] = items.filter(function (row) { return row.id !== id; });
      }
    });
  }
  function updateCallbacks(provider, prefix) {
    if (pendingUpdates[provider] === void 0) {
      pendingUpdates[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerPendingUpdates = pendingUpdates[provider];
    if (!providerPendingUpdates[prefix]) {
      providerPendingUpdates[prefix] = true;
      setTimeout(function () {
        providerPendingUpdates[prefix] = false;
        if (callbacks[provider] === void 0 || callbacks[provider][prefix] === void 0) {
          return;
        }
        var items = callbacks[provider][prefix].slice(0);
        if (!items.length) {
          return;
        }
        var storage = getStorage(provider, prefix);
        var hasPending = false;
        items.forEach(function (item) {
          var icons = item.icons;
          var oldLength = icons.pending.length;
          icons.pending = icons.pending.filter(function (icon) {
            if (icon.prefix !== prefix) {
              return true;
            }
            var name = icon.name;
            if (storage.icons[name] !== void 0) {
              icons.loaded.push({
                provider: provider,
                prefix: prefix,
                name: name
              });
            } else if (storage.missing[name] !== void 0) {
              icons.missing.push({
                provider: provider,
                prefix: prefix,
                name: name
              });
            } else {
              hasPending = true;
              return true;
            }
            return false;
          });
          if (icons.pending.length !== oldLength) {
            if (!hasPending) {
              removeCallback([
                {
                  provider: provider,
                  prefix: prefix
                }
              ], item.id);
            }
            item.callback(icons.loaded.slice(0), icons.missing.slice(0), icons.pending.slice(0), item.abort);
          }
        });
      });
    }
  }
  var idCounter = 0;
  function storeCallback(callback, icons, pendingSources) {
    var id = idCounter++;
    var abort = removeCallback.bind(null, pendingSources, id);
    if (!icons.pending.length) {
      return abort;
    }
    var item = {
      id: id,
      icons: icons,
      callback: callback,
      abort: abort
    };
    pendingSources.forEach(function (source) {
      var provider = source.provider;
      var prefix = source.prefix;
      if (callbacks[provider] === void 0) {
        callbacks[provider] = /* @__PURE__ */ Object.create(null);
      }
      var providerCallbacks = callbacks[provider];
      if (providerCallbacks[prefix] === void 0) {
        providerCallbacks[prefix] = [];
      }
      providerCallbacks[prefix].push(item);
    });
    return abort;
  }

  function listToIcons(list, validate, simpleNames) {
    if ( validate === void 0 ) validate = true;
    if ( simpleNames === void 0 ) simpleNames = false;

    var result = [];
    list.forEach(function (item) {
      var icon = typeof item === "string" ? stringToIcon(item, false, simpleNames) : item;
      if (!validate || validateIcon(icon, simpleNames)) {
        result.push({
          provider: icon.provider,
          prefix: icon.prefix,
          name: icon.name
        });
      }
    });
    return result;
  }

  // src/config.ts
  var defaultConfig = {
    resources: [],
    index: 0,
    timeout: 2e3,
    rotate: 750,
    random: false,
    dataAfterTimeout: false
  };

  // src/query.ts
  function sendQuery(config, payload, query, done) {
    var resourcesCount = config.resources.length;
    var startIndex = config.random ? Math.floor(Math.random() * resourcesCount) : config.index;
    var resources;
    if (config.random) {
      var list = config.resources.slice(0);
      resources = [];
      while (list.length > 1) {
        var nextIndex = Math.floor(Math.random() * list.length);
        resources.push(list[nextIndex]);
        list = list.slice(0, nextIndex).concat(list.slice(nextIndex + 1));
      }
      resources = resources.concat(list);
    } else {
      resources = config.resources.slice(startIndex).concat(config.resources.slice(0, startIndex));
    }
    var startTime = Date.now();
    var status = "pending";
    var queriesSent = 0;
    var lastError;
    var timer = null;
    var queue = [];
    var doneCallbacks = [];
    if (typeof done === "function") {
      doneCallbacks.push(done);
    }
    function resetTimer() {
      if (timer) {
        clearTimeout(timer);
        timer = null;
      }
    }
    function abort() {
      if (status === "pending") {
        status = "aborted";
      }
      resetTimer();
      queue.forEach(function (item) {
        if (item.status === "pending") {
          item.status = "aborted";
        }
      });
      queue = [];
    }
    function subscribe(callback, overwrite) {
      if (overwrite) {
        doneCallbacks = [];
      }
      if (typeof callback === "function") {
        doneCallbacks.push(callback);
      }
    }
    function getQueryStatus() {
      return {
        startTime: startTime,
        payload: payload,
        status: status,
        queriesSent: queriesSent,
        queriesPending: queue.length,
        subscribe: subscribe,
        abort: abort
      };
    }
    function failQuery() {
      status = "failed";
      doneCallbacks.forEach(function (callback) {
        callback(void 0, lastError);
      });
    }
    function clearQueue() {
      queue.forEach(function (item) {
        if (item.status === "pending") {
          item.status = "aborted";
        }
      });
      queue = [];
    }
    function moduleResponse(item, response, data) {
      var isError = response !== "success";
      queue = queue.filter(function (queued) { return queued !== item; });
      switch (status) {
        case "pending":
          break;
        case "failed":
          if (isError || !config.dataAfterTimeout) {
            return;
          }
          break;
        default:
          return;
      }
      if (response === "abort") {
        lastError = data;
        failQuery();
        return;
      }
      if (isError) {
        lastError = data;
        if (!queue.length) {
          if (!resources.length) {
            failQuery();
          } else {
            execNext();
          }
        }
        return;
      }
      resetTimer();
      clearQueue();
      if (!config.random) {
        var index = config.resources.indexOf(item.resource);
        if (index !== -1 && index !== config.index) {
          config.index = index;
        }
      }
      status = "completed";
      doneCallbacks.forEach(function (callback) {
        callback(data);
      });
    }
    function execNext() {
      if (status !== "pending") {
        return;
      }
      resetTimer();
      var resource = resources.shift();
      if (resource === void 0) {
        if (queue.length) {
          timer = setTimeout(function () {
            resetTimer();
            if (status === "pending") {
              clearQueue();
              failQuery();
            }
          }, config.timeout);
          return;
        }
        failQuery();
        return;
      }
      var item = {
        status: "pending",
        resource: resource,
        callback: function (status2, data) {
          moduleResponse(item, status2, data);
        }
      };
      queue.push(item);
      queriesSent++;
      timer = setTimeout(execNext, config.rotate);
      query(resource, payload, item.callback);
    }
    setTimeout(execNext);
    return getQueryStatus;
  }

  // src/index.ts
  function setConfig(config) {
    if (typeof config !== "object" || typeof config.resources !== "object" || !(config.resources instanceof Array) || !config.resources.length) {
      throw new Error("Invalid Reduncancy configuration");
    }
    var newConfig = /* @__PURE__ */ Object.create(null);
    var key;
    for (key in defaultConfig) {
      if (config[key] !== void 0) {
        newConfig[key] = config[key];
      } else {
        newConfig[key] = defaultConfig[key];
      }
    }
    return newConfig;
  }
  function initRedundancy(cfg) {
    var config = setConfig(cfg);
    var queries = [];
    function cleanup() {
      queries = queries.filter(function (item) { return item().status === "pending"; });
    }
    function query(payload, queryCallback, doneCallback) {
      var query2 = sendQuery(config, payload, queryCallback, function (data, error) {
        cleanup();
        if (doneCallback) {
          doneCallback(data, error);
        }
      });
      queries.push(query2);
      return query2;
    }
    function find(callback) {
      var result = queries.find(function (value) {
        return callback(value);
      });
      return result !== void 0 ? result : null;
    }
    var instance = {
      query: query,
      find: find,
      setIndex: function (index) {
        config.index = index;
      },
      getIndex: function () { return config.index; },
      cleanup: cleanup
    };
    return instance;
  }

  function emptyCallback$1() {
  }
  var redundancyCache = /* @__PURE__ */ Object.create(null);
  function getRedundancyCache(provider) {
    if (redundancyCache[provider] === void 0) {
      var config = getAPIConfig(provider);
      if (!config) {
        return;
      }
      var redundancy = initRedundancy(config);
      var cachedReundancy = {
        config: config,
        redundancy: redundancy
      };
      redundancyCache[provider] = cachedReundancy;
    }
    return redundancyCache[provider];
  }
  function sendAPIQuery(target, query, callback) {
    var redundancy;
    var send;
    if (typeof target === "string") {
      var api = getAPIModule(target);
      if (!api) {
        callback(void 0, 424);
        return emptyCallback$1;
      }
      send = api.send;
      var cached = getRedundancyCache(target);
      if (cached) {
        redundancy = cached.redundancy;
      }
    } else {
      var config = createAPIConfig(target);
      if (config) {
        redundancy = initRedundancy(config);
        var moduleKey = target.resources ? target.resources[0] : "";
        var api$1 = getAPIModule(moduleKey);
        if (api$1) {
          send = api$1.send;
        }
      }
    }
    if (!redundancy || !send) {
      callback(void 0, 424);
      return emptyCallback$1;
    }
    return redundancy.query(query, send, callback)().abort;
  }

  function emptyCallback() {
  }
  var pendingIcons = /* @__PURE__ */ Object.create(null);
  var iconsToLoad = /* @__PURE__ */ Object.create(null);
  var loaderFlags = /* @__PURE__ */ Object.create(null);
  var queueFlags = /* @__PURE__ */ Object.create(null);
  function loadedNewIcons(provider, prefix) {
    if (loaderFlags[provider] === void 0) {
      loaderFlags[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerLoaderFlags = loaderFlags[provider];
    if (!providerLoaderFlags[prefix]) {
      providerLoaderFlags[prefix] = true;
      setTimeout(function () {
        providerLoaderFlags[prefix] = false;
        updateCallbacks(provider, prefix);
      });
    }
  }
  var errorsCache = /* @__PURE__ */ Object.create(null);
  function loadNewIcons(provider, prefix, icons) {
    function err() {
      var key = (provider === "" ? "" : "@" + provider + ":") + prefix;
      var time = Math.floor(Date.now() / 6e4);
      if (errorsCache[key] < time) {
        errorsCache[key] = time;
        console.error('Unable to retrieve icons for "' + key + '" because API is not configured properly.');
      }
    }
    if (iconsToLoad[provider] === void 0) {
      iconsToLoad[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerIconsToLoad = iconsToLoad[provider];
    if (queueFlags[provider] === void 0) {
      queueFlags[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerQueueFlags = queueFlags[provider];
    if (pendingIcons[provider] === void 0) {
      pendingIcons[provider] = /* @__PURE__ */ Object.create(null);
    }
    var providerPendingIcons = pendingIcons[provider];
    if (providerIconsToLoad[prefix] === void 0) {
      providerIconsToLoad[prefix] = icons;
    } else {
      providerIconsToLoad[prefix] = providerIconsToLoad[prefix].concat(icons).sort();
    }
    if (!providerQueueFlags[prefix]) {
      providerQueueFlags[prefix] = true;
      setTimeout(function () {
        providerQueueFlags[prefix] = false;
        var icons2 = providerIconsToLoad[prefix];
        delete providerIconsToLoad[prefix];
        var api = getAPIModule(provider);
        if (!api) {
          err();
          return;
        }
        var params = api.prepare(provider, prefix, icons2);
        params.forEach(function (item) {
          sendAPIQuery(provider, item, function (data, error) {
            var storage = getStorage(provider, prefix);
            if (typeof data !== "object") {
              if (error !== 404) {
                return;
              }
              var t = Date.now();
              item.icons.forEach(function (name) {
                storage.missing[name] = t;
              });
            } else {
              try {
                var parsed = addIconSet(storage, data);
                if (!parsed.length) {
                  return;
                }
                var pending = providerPendingIcons[prefix];
                parsed.forEach(function (name) {
                  delete pending[name];
                });
                if (cache.store) {
                  cache.store(provider, data);
                }
              } catch (err2) {
                console.error(err2);
              }
            }
            loadedNewIcons(provider, prefix);
          });
        });
      });
    }
  }
  var isPending = function (icon) {
    var provider = icon.provider;
    var prefix = icon.prefix;
    return pendingIcons[provider] && pendingIcons[provider][prefix] && pendingIcons[provider][prefix][icon.name] !== void 0;
  };
  var loadIcons = function (icons, callback) {
    var cleanedIcons = listToIcons(icons, true, allowSimpleNames());
    var sortedIcons = sortIcons(cleanedIcons);
    if (!sortedIcons.pending.length) {
      var callCallback = true;
      if (callback) {
        setTimeout(function () {
          if (callCallback) {
            callback(sortedIcons.loaded, sortedIcons.missing, sortedIcons.pending, emptyCallback);
          }
        });
      }
      return function () {
        callCallback = false;
      };
    }
    var newIcons = /* @__PURE__ */ Object.create(null);
    var sources = [];
    var lastProvider, lastPrefix;
    sortedIcons.pending.forEach(function (icon) {
      var provider = icon.provider;
      var prefix = icon.prefix;
      if (prefix === lastPrefix && provider === lastProvider) {
        return;
      }
      lastProvider = provider;
      lastPrefix = prefix;
      sources.push({
        provider: provider,
        prefix: prefix
      });
      if (pendingIcons[provider] === void 0) {
        pendingIcons[provider] = /* @__PURE__ */ Object.create(null);
      }
      var providerPendingIcons = pendingIcons[provider];
      if (providerPendingIcons[prefix] === void 0) {
        providerPendingIcons[prefix] = /* @__PURE__ */ Object.create(null);
      }
      if (newIcons[provider] === void 0) {
        newIcons[provider] = /* @__PURE__ */ Object.create(null);
      }
      var providerNewIcons = newIcons[provider];
      if (providerNewIcons[prefix] === void 0) {
        providerNewIcons[prefix] = [];
      }
    });
    var time = Date.now();
    sortedIcons.pending.forEach(function (icon) {
      var provider = icon.provider;
      var prefix = icon.prefix;
      var name = icon.name;
      var pendingQueue = pendingIcons[provider][prefix];
      if (pendingQueue[name] === void 0) {
        pendingQueue[name] = time;
        newIcons[provider][prefix].push(name);
      }
    });
    sources.forEach(function (source) {
      var provider = source.provider;
      var prefix = source.prefix;
      if (newIcons[provider][prefix].length) {
        loadNewIcons(provider, prefix, newIcons[provider][prefix]);
      }
    });
    return callback ? storeCallback(callback, sortedIcons, sources) : emptyCallback;
  };
  var loadIcon = function (icon) {
    return new Promise(function (fulfill, reject) {
      var iconObj = typeof icon === "string" ? stringToIcon(icon) : icon;
      loadIcons([iconObj || icon], function (loaded) {
        if (loaded.length && iconObj) {
          var storage = getStorage(iconObj.provider, iconObj.prefix);
          var data = getIconFromStorage(storage, iconObj.name);
          if (data) {
            fulfill(data);
            return;
          }
        }
        reject(icon);
      });
    });
  };

  /**
   * Names of properties to add to nodes
   */
  var elementFinderProperty = ('iconifyFinder' + Date.now());
  var elementDataProperty = ('iconifyData' + Date.now());

  /**
   * Replace element with SVG
   */
  function renderIconInPlaceholder(placeholder, customisations, iconData, returnString) {
      // Create placeholder. Why placeholder? IE11 doesn't support innerHTML method on SVG.
      var span;
      try {
          span = document.createElement('span');
      }
      catch (err) {
          return returnString ? '' : null;
      }
      var data = iconToSVG(iconData, mergeCustomisations(defaults, customisations));
      // Placeholder properties
      var placeholderElement = placeholder.element;
      var finder = placeholder.finder;
      var name = placeholder.name;
      // Get class name
      var placeholderClassName = placeholderElement
          ? placeholderElement.getAttribute('class')
          : '';
      var filteredClassList = finder
          ? finder.classFilter(placeholderClassName ? placeholderClassName.split(/\s+/) : [])
          : [];
      var className = 'iconify iconify--' +
          name.prefix +
          (name.provider === '' ? '' : ' iconify--' + name.provider) +
          (filteredClassList.length ? ' ' + filteredClassList.join(' ') : '');
      // Generate SVG as string
      var html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="' +
          className +
          '">' +
          replaceIDs(data.body) +
          '</svg>';
      // Set HTML for placeholder
      span.innerHTML = html;
      // Get SVG element
      var svg = span.childNodes[0];
      var svgStyle = svg.style;
      // Add attributes
      var svgAttributes = data.attributes;
      Object.keys(svgAttributes).forEach(function (attr) {
          svg.setAttribute(attr, svgAttributes[attr]);
      });
      // Add custom styles
      if (data.inline) {
          svgStyle.verticalAlign = '-0.125em';
      }
      // Copy stuff from placeholder
      if (placeholderElement) {
          // Copy attributes
          var placeholderAttributes = placeholderElement.attributes;
          for (var i = 0; i < placeholderAttributes.length; i++) {
              var item = placeholderAttributes.item(i);
              if (item) {
                  var name$1 = item.name;
                  if (name$1 !== 'class' &&
                      name$1 !== 'style' &&
                      svgAttributes[name$1] === void 0) {
                      try {
                          svg.setAttribute(name$1, item.value);
                      }
                      catch (err$1) {
                          //
                      }
                  }
              }
          }
          // Copy styles
          var placeholderStyle = placeholderElement.style;
          for (var i$1 = 0; i$1 < placeholderStyle.length; i$1++) {
              var attr = placeholderStyle[i$1];
              svgStyle[attr] = placeholderStyle[attr];
          }
      }
      // Store finder specific data
      if (finder) {
          var elementData = {
              name: name,
              status: 'loaded',
              customisations: customisations,
          };
          svg[elementDataProperty] = elementData;
          svg[elementFinderProperty] = finder;
      }
      // Get result
      var result = returnString ? span.innerHTML : svg;
      // Replace placeholder
      if (placeholderElement && placeholderElement.parentNode) {
          placeholderElement.parentNode.replaceChild(svg, placeholderElement);
      }
      else {
          // Placeholder has no parent? Remove SVG parent as well
          span.removeChild(svg);
      }
      // Return new node
      return result;
  }

  /**
   * List of root nodes
   */
  var nodes = [];
  /**
   * Find node
   */
  function findRootNode(node) {
      for (var i = 0; i < nodes.length; i++) {
          var item = nodes[i];
          var root = typeof item.node === 'function' ? item.node() : item.node;
          if (root === node) {
              return item;
          }
      }
  }
  /**
   * Add extra root node
   */
  function addRootNode(root, autoRemove) {
      if ( autoRemove === void 0 ) autoRemove = false;

      var node = findRootNode(root);
      if (node) {
          // Node already exist: switch type if needed
          if (node.temporary) {
              node.temporary = autoRemove;
          }
          return node;
      }
      // Create item, add it to list, start observer
      node = {
          node: root,
          temporary: autoRemove,
      };
      nodes.push(node);
      return node;
  }
  /**
   * Add document.body node
   */
  function addBodyNode() {
      if (document.documentElement) {
          return addRootNode(document.documentElement);
      }
      nodes.push({
          node: function () {
              return document.documentElement;
          },
      });
  }
  /**
   * Remove root node
   */
  function removeRootNode(root) {
      nodes = nodes.filter(function (node) {
          var element = typeof node.node === 'function' ? node.node() : node.node;
          return root !== element;
      });
  }
  /**
   * Get list of root nodes
   */
  function listRootNodes() {
      return nodes;
  }

  /**
   * Execute function when DOM is ready
   */
  function onReady(callback) {
      var doc = document;
      if (doc.readyState === 'complete' ||
          (doc.readyState !== 'loading' &&
              !doc.documentElement.doScroll)) {
          callback();
      }
      else {
          doc.addEventListener('DOMContentLoaded', callback);
          window.addEventListener('load', callback);
      }
  }

  /**
   * Callback
   */
  var callback = null;
  /**
   * Parameters for mutation observer
   */
  var observerParams = {
      childList: true,
      subtree: true,
      attributes: true,
  };
  /**
   * Queue DOM scan
   */
  function queueScan(node) {
      if (!node.observer) {
          return;
      }
      var observer = node.observer;
      if (!observer.pendingScan) {
          observer.pendingScan = setTimeout(function () {
              delete observer.pendingScan;
              if (callback) {
                  callback(node);
              }
          });
      }
  }
  /**
   * Check mutations for added nodes
   */
  function checkMutations(node, mutations) {
      if (!node.observer) {
          return;
      }
      var observer = node.observer;
      if (!observer.pendingScan) {
          for (var i = 0; i < mutations.length; i++) {
              var item = mutations[i];
              if (
              // Check for added nodes
              (item.addedNodes && item.addedNodes.length > 0) ||
                  // Check for icon or placeholder with modified attributes
                  (item.type === 'attributes' &&
                      item.target[elementFinderProperty] !==
                          void 0)) {
                  if (!observer.paused) {
                      queueScan(node);
                  }
                  return;
              }
          }
      }
  }
  /**
   * Start/resume observer
   */
  function continueObserving(node, root) {
      node.observer.instance.observe(root, observerParams);
  }
  /**
   * Start mutation observer
   */
  function startObserver(node) {
      var observer = node.observer;
      if (observer && observer.instance) {
          // Already started
          return;
      }
      var root = typeof node.node === 'function' ? node.node() : node.node;
      if (!root) {
          // document.body is not available yet
          return;
      }
      if (!observer) {
          observer = {
              paused: 0,
          };
          node.observer = observer;
      }
      // Create new instance, observe
      observer.instance = new MutationObserver(checkMutations.bind(null, node));
      continueObserving(node, root);
      // Scan immediately
      if (!observer.paused) {
          queueScan(node);
      }
  }
  /**
   * Start all observers
   */
  function startObservers() {
      listRootNodes().forEach(startObserver);
  }
  /**
   * Stop observer
   */
  function stopObserver(node) {
      if (!node.observer) {
          return;
      }
      var observer = node.observer;
      // Stop scan
      if (observer.pendingScan) {
          clearTimeout(observer.pendingScan);
          delete observer.pendingScan;
      }
      // Disconnect observer
      if (observer.instance) {
          observer.instance.disconnect();
          delete observer.instance;
      }
  }
  /**
   * Start observer when DOM is ready
   */
  function initObserver(cb) {
      var isRestart = callback !== null;
      if (callback !== cb) {
          // Change callback and stop all pending observers
          callback = cb;
          if (isRestart) {
              listRootNodes().forEach(stopObserver);
          }
      }
      if (isRestart) {
          // Restart instances
          startObservers();
          return;
      }
      // Start observers when document is ready
      onReady(startObservers);
  }
  /**
   * Pause observing node
   */
  function pauseObservingNode(node) {
      (node ? [node] : listRootNodes()).forEach(function (node) {
          if (!node.observer) {
              node.observer = {
                  paused: 1,
              };
              return;
          }
          var observer = node.observer;
          observer.paused++;
          if (observer.paused > 1 || !observer.instance) {
              return;
          }
          // Disconnect observer
          var instance = observer.instance;
          // checkMutations(node, instance.takeRecords());
          instance.disconnect();
      });
  }
  /**
   * Pause observer
   */
  function pauseObserver(root) {
      if (root) {
          var node = findRootNode(root);
          if (node) {
              pauseObservingNode(node);
          }
      }
      else {
          pauseObservingNode();
      }
  }
  /**
   * Resume observer
   */
  function resumeObservingNode(observer) {
      (observer ? [observer] : listRootNodes()).forEach(function (node) {
          if (!node.observer) {
              // Start observer
              startObserver(node);
              return;
          }
          var observer = node.observer;
          if (observer.paused) {
              observer.paused--;
              if (!observer.paused) {
                  // Start / resume
                  var root = typeof node.node === 'function' ? node.node() : node.node;
                  if (!root) {
                      return;
                  }
                  else if (observer.instance) {
                      continueObserving(node, root);
                  }
                  else {
                      startObserver(node);
                  }
              }
          }
      });
  }
  /**
   * Resume observer
   */
  function resumeObserver(root) {
      if (root) {
          var node = findRootNode(root);
          if (node) {
              resumeObservingNode(node);
          }
      }
      else {
          resumeObservingNode();
      }
  }
  /**
   * Observe node
   */
  function observe(root, autoRemove) {
      if ( autoRemove === void 0 ) autoRemove = false;

      var node = addRootNode(root, autoRemove);
      startObserver(node);
      return node;
  }
  /**
   * Remove observed node
   */
  function stopObserving(root) {
      var node = findRootNode(root);
      if (node) {
          stopObserver(node);
          removeRootNode(root);
      }
  }

  /**
   * List of modules
   */
  var finders = [];
  /**
   * Add module
   */
  function addFinder(finder) {
      if (finders.indexOf(finder) === -1) {
          finders.push(finder);
      }
  }
  /**
   * Clean icon name: convert from string if needed and validate
   */
  function cleanIconName(name) {
      if (typeof name === 'string') {
          name = stringToIcon(name);
      }
      return name === null || !validateIcon(name) ? null : name;
  }
  /**
   * Compare customisations. Returns true if identical
   */
  function compareCustomisations(list1, list2) {
      var keys1 = Object.keys(list1);
      var keys2 = Object.keys(list2);
      if (keys1.length !== keys2.length) {
          return false;
      }
      for (var i = 0; i < keys1.length; i++) {
          var key = keys1[i];
          if (list2[key] !== list1[key]) {
              return false;
          }
      }
      return true;
  }
  /**
   * Find all placeholders
   */
  function findPlaceholders(root) {
      var results = [];
      finders.forEach(function (finder) {
          var elements = finder.find(root);
          Array.prototype.forEach.call(elements, function (item) {
              var element = item;
              if (element[elementFinderProperty] !== void 0 &&
                  element[elementFinderProperty] !== finder) {
                  // Element is assigned to a different finder
                  return;
              }
              // Get icon name
              var name = cleanIconName(finder.name(element));
              if (name === null) {
                  // Invalid name - do not assign this finder to element
                  return;
              }
              // Assign finder to element and add it to results
              element[elementFinderProperty] = finder;
              var placeholder = {
                  element: element,
                  finder: finder,
                  name: name,
              };
              results.push(placeholder);
          });
      });
      // Find all modified SVG
      var elements = root.querySelectorAll('svg.iconify');
      Array.prototype.forEach.call(elements, function (item) {
          var element = item;
          var finder = element[elementFinderProperty];
          var data = element[elementDataProperty];
          if (!finder || !data) {
              return;
          }
          // Get icon name
          var name = cleanIconName(finder.name(element));
          if (name === null) {
              // Invalid name
              return;
          }
          var updated = false;
          var customisations;
          if (name.prefix !== data.name.prefix || name.name !== data.name.name) {
              updated = true;
          }
          else {
              customisations = finder.customisations(element);
              if (!compareCustomisations(data.customisations, customisations)) {
                  updated = true;
              }
          }
          // Add item to results
          if (updated) {
              var placeholder = {
                  element: element,
                  finder: finder,
                  name: name,
                  customisations: customisations,
              };
              results.push(placeholder);
          }
      });
      return results;
  }

  /**
   * Flag to avoid scanning DOM too often
   */
  var scanQueued = false;
  /**
   * Icons have been loaded
   */
  function checkPendingIcons() {
      if (!scanQueued) {
          scanQueued = true;
          setTimeout(function () {
              if (scanQueued) {
                  scanQueued = false;
                  scanDOM();
              }
          });
      }
  }
  /**
   * Compare Icon objects. Returns true if icons are identical.
   *
   * Note: null means icon is invalid, so null to null comparison = false.
   */
  var compareIcons = function (icon1, icon2) {
      return (icon1 !== null &&
          icon2 !== null &&
          icon1.name === icon2.name &&
          icon1.prefix === icon2.prefix);
  };
  /**
   * Scan node for placeholders
   */
  function scanElement(root) {
      // Add temporary node
      var node = findRootNode(root);
      if (!node) {
          scanDOM({
              node: root,
              temporary: true,
          }, true);
      }
      else {
          scanDOM(node);
      }
  }
  /**
   * Scan DOM for placeholders
   */
  function scanDOM(node, addTempNode) {
      if ( addTempNode === void 0 ) addTempNode = false;

      scanQueued = false;
      // List of icons to load: [provider][prefix][name] = boolean
      var iconsToLoad = Object.create(null);
      // Get placeholders
      (node ? [node] : listRootNodes()).forEach(function (node) {
          var root = typeof node.node === 'function' ? node.node() : node.node;
          if (!root || !root.querySelectorAll) {
              return;
          }
          // Track placeholders
          var hasPlaceholders = false;
          // Observer
          var paused = false;
          // Find placeholders
          findPlaceholders(root).forEach(function (item) {
              var element = item.element;
              var iconName = item.name;
              var provider = iconName.provider;
              var prefix = iconName.prefix;
              var name = iconName.name;
              var data = element[elementDataProperty];
              // Icon has not been updated since last scan
              if (data !== void 0 && compareIcons(data.name, iconName)) {
                  // Icon name was not changed and data is set - quickly return if icon is missing or still loading
                  switch (data.status) {
                      case 'missing':
                          return;
                      case 'loading':
                          if (isPending({
                              provider: provider,
                              prefix: prefix,
                              name: name,
                          })) {
                              // Pending
                              hasPlaceholders = true;
                              return;
                          }
                  }
              }
              // Check icon
              var storage = getStorage(provider, prefix);
              if (storage.icons[name] !== void 0) {
                  // Icon exists - pause observer before replacing placeholder
                  if (!paused && node.observer) {
                      pauseObservingNode(node);
                      paused = true;
                  }
                  // Get customisations
                  var customisations = item.customisations !== void 0
                      ? item.customisations
                      : item.finder.customisations(element);
                  // Render icon
                  renderIconInPlaceholder(item, customisations, getIconFromStorage(storage, name));
                  return;
              }
              if (storage.missing[name]) {
                  // Mark as missing
                  data = {
                      name: iconName,
                      status: 'missing',
                      customisations: {},
                  };
                  element[elementDataProperty] = data;
                  return;
              }
              if (!isPending({ provider: provider, prefix: prefix, name: name })) {
                  // Add icon to loading queue
                  if (iconsToLoad[provider] === void 0) {
                      iconsToLoad[provider] = Object.create(null);
                  }
                  var providerIconsToLoad = iconsToLoad[provider];
                  if (providerIconsToLoad[prefix] === void 0) {
                      providerIconsToLoad[prefix] = Object.create(null);
                  }
                  providerIconsToLoad[prefix][name] = true;
              }
              // Mark as loading
              data = {
                  name: iconName,
                  status: 'loading',
                  customisations: {},
              };
              element[elementDataProperty] = data;
              hasPlaceholders = true;
          });
          // Node stuff
          if (node.temporary && !hasPlaceholders) {
              // Remove temporary node
              stopObserving(root);
          }
          else if (addTempNode && hasPlaceholders) {
              // Add new temporary node
              observe(root, true);
          }
          else if (paused && node.observer) {
              // Resume observer
              resumeObservingNode(node);
          }
      });
      // Load icons
      Object.keys(iconsToLoad).forEach(function (provider) {
          var providerIconsToLoad = iconsToLoad[provider];
          Object.keys(providerIconsToLoad).forEach(function (prefix) {
              loadIcons(Object.keys(providerIconsToLoad[prefix]).map(function (name) {
                  var icon = {
                      provider: provider,
                      prefix: prefix,
                      name: name,
                  };
                  return icon;
              }), checkPendingIcons);
          });
      });
  }

  function rotateFromString(value, defaultValue) {
    if ( defaultValue === void 0 ) defaultValue = 0;

    var units = value.replace(/^-?[0-9.]*/, "");
    function cleanup(value2) {
      while (value2 < 0) {
        value2 += 4;
      }
      return value2 % 4;
    }
    if (units === "") {
      var num = parseInt(value);
      return isNaN(num) ? 0 : cleanup(num);
    } else if (units !== value) {
      var split = 0;
      switch (units) {
        case "%":
          split = 25;
          break;
        case "deg":
          split = 90;
      }
      if (split) {
        var num$1 = parseFloat(value.slice(0, value.length - units.length));
        if (isNaN(num$1)) {
          return 0;
        }
        num$1 = num$1 / split;
        return num$1 % 1 === 0 ? cleanup(num$1) : 0;
      }
    }
    return defaultValue;
  }

  var separator = /[\s,]+/;
  function flipFromString(custom, flip) {
    flip.split(separator).forEach(function (str) {
      var value = str.trim();
      switch (value) {
        case "horizontal":
          custom.hFlip = true;
          break;
        case "vertical":
          custom.vFlip = true;
          break;
      }
    });
  }
  function alignmentFromString(custom, align) {
    align.split(separator).forEach(function (str) {
      var value = str.trim();
      switch (value) {
        case "left":
        case "center":
        case "right":
          custom.hAlign = value;
          break;
        case "top":
        case "middle":
        case "bottom":
          custom.vAlign = value;
          break;
        case "slice":
        case "crop":
          custom.slice = true;
          break;
        case "meet":
          custom.slice = false;
      }
    });
  }

  /**
   * Check if attribute exists
   */
  function hasAttribute(element, key) {
      return element.hasAttribute(key);
  }
  /**
   * Get attribute value
   */
  function getAttribute(element, key) {
      return element.getAttribute(key);
  }
  /**
   * Get attribute value
   */
  function getBooleanAttribute(element, key) {
      var value = element.getAttribute(key);
      if (value === key || value === 'true') {
          return true;
      }
      if (value === '' || value === 'false') {
          return false;
      }
      return null;
  }
  /**
   * Boolean attributes
   */
  var booleanAttributes = [
      'inline',
      'hFlip',
      'vFlip' ];
  /**
   * String attributes
   */
  var stringAttributes = [
      'width',
      'height' ];
  /**
   * Class names
   */
  var mainClass = 'iconify';
  var inlineClass = 'iconify-inline';
  /**
   * Selector combining class names and tags
   */
  var selector = 'i.' +
      mainClass +
      ', span.' +
      mainClass +
      ', i.' +
      inlineClass +
      ', span.' +
      inlineClass;
  /**
   * Export finder for:
   *  <span class="iconify" />
   *  <i class="iconify" />
   *  <span class="iconify-inline" />
   *  <i class="iconify-inline" />
   */
  var finder = {
      /**
       * Find all elements
       */
      find: function (root) { return root.querySelectorAll(selector); },
      /**
       * Get icon name from element
       */
      name: function (element) {
          if (hasAttribute(element, 'data-icon')) {
              return getAttribute(element, 'data-icon');
          }
          return null;
      },
      /**
       * Get customisations list from element
       */
      customisations: function (element, defaultValues) {
          if ( defaultValues === void 0 ) defaultValues = {
          inline: false,
      };

          var result = defaultValues;
          // Check class list for inline class
          var className = element.getAttribute('class');
          var classList = className ? className.split(/\s+/) : [];
          if (classList.indexOf(inlineClass) !== -1) {
              result.inline = true;
          }
          // Rotation
          if (hasAttribute(element, 'data-rotate')) {
              var value = rotateFromString(getAttribute(element, 'data-rotate'));
              if (value) {
                  result.rotate = value;
              }
          }
          // Shorthand attributes
          if (hasAttribute(element, 'data-flip')) {
              flipFromString(result, getAttribute(element, 'data-flip'));
          }
          if (hasAttribute(element, 'data-align')) {
              alignmentFromString(result, getAttribute(element, 'data-align'));
          }
          // Boolean attributes
          booleanAttributes.forEach(function (attr) {
              if (hasAttribute(element, 'data-' + attr)) {
                  var value = getBooleanAttribute(element, 'data-' + attr);
                  if (typeof value === 'boolean') {
                      result[attr] = value;
                  }
              }
          });
          // String attributes
          stringAttributes.forEach(function (attr) {
              if (hasAttribute(element, 'data-' + attr)) {
                  var value = getAttribute(element, 'data-' + attr);
                  if (value !== '') {
                      result[attr] = value;
                  }
              }
          });
          return result;
      },
      /**
       * Filter classes
       */
      classFilter: function (classList) {
          var result = [];
          classList.forEach(function (className) {
              if (className !== 'iconify' &&
                  className !== '' &&
                  className.slice(0, 9) !== 'iconify--') {
                  result.push(className);
              }
          });
          return result;
      },
  };

  // import { finder as iconifyIconFinder } from './finders/iconify-icon';
  /**
   * Generate icon
   */
  function generateIcon(name, customisations, returnString) {
      // Get icon data
      var iconData = getIconData(name);
      if (!iconData) {
          return null;
      }
      // Split name
      var iconName = stringToIcon(name);
      // Clean up customisations
      var changes = mergeCustomisations(defaults, typeof customisations === 'object' ? customisations : {});
      // Get data
      return renderIconInPlaceholder({
          name: iconName,
      }, changes, iconData, returnString);
  }
  /**
   * Get version
   */
  function getVersion() {
      return '2.2.1';
  }
  /**
   * Generate SVG element
   */
  function renderSVG(name, customisations) {
      return generateIcon(name, customisations, false);
  }
  /**
   * Generate SVG as string
   */
  function renderHTML(name, customisations) {
      return generateIcon(name, customisations, true);
  }
  /**
   * Get rendered icon as object that can be used to create SVG (use replaceIDs on body)
   */
  function renderIcon(name, customisations) {
      // Get icon data
      var iconData = getIconData(name);
      if (!iconData) {
          return null;
      }
      // Clean up customisations
      var changes = mergeCustomisations(defaults, typeof customisations === 'object' ? customisations : {});
      // Get data
      return iconToSVG(iconData, changes);
  }
  /**
   * Scan DOM
   */
  function scan(root) {
      if (root) {
          scanElement(root);
      }
      else {
          scanDOM();
      }
  }
  /**
   * Initialise stuff
   */
  if (typeof document !== 'undefined' && typeof window !== 'undefined') {
      // Add document.body node
      addBodyNode();
      // Add finder modules
      // addFinder(iconifyIconFinder);
      addFinder(finder);
      var _window$1 = window;
      // Load icons from global "IconifyPreload"
      if (_window$1.IconifyPreload !== void 0) {
          var preload = _window$1.IconifyPreload;
          var err$1 = 'Invalid IconifyPreload syntax.';
          if (typeof preload === 'object' && preload !== null) {
              (preload instanceof Array ? preload : [preload]).forEach(function (item) {
                  try {
                      if (
                      // Check if item is an object and not null/array
                      typeof item !== 'object' ||
                          item === null ||
                          item instanceof Array ||
                          // Check for 'icons' and 'prefix'
                          typeof item.icons !== 'object' ||
                          typeof item.prefix !== 'string' ||
                          // Add icon set
                          !addCollection(item)) {
                          console.error(err$1);
                      }
                  }
                  catch (e) {
                      console.error(err$1);
                  }
              });
          }
      }
      // Load observer and scan DOM on next tick
      setTimeout(function () {
          initObserver(scanDOM);
          scanDOM();
      });
  }

  /**
   * Enable cache
   */
  function enableCache(storage, enable) {
      toggleBrowserCache(storage, enable !== false);
  }
  /**
   * Disable cache
   */
  function disableCache(storage) {
      toggleBrowserCache(storage, true);
  }
  /**
   * Initialise stuff
   */
  // Set API module
  setAPIModule('', fetchAPIModule);
  /**
   * Browser stuff
   */
  if (typeof document !== 'undefined' && typeof window !== 'undefined') {
      // Set cache and load existing cache
      cache.store = storeCache;
      loadCache();
      var _window = window;
      // Set API from global "IconifyProviders"
      if (_window.IconifyProviders !== void 0) {
          var providers = _window.IconifyProviders;
          if (typeof providers === 'object' && providers !== null) {
              for (var key in providers) {
                  var err = 'IconifyProviders[' + key + '] is invalid.';
                  try {
                      var value = providers[key];
                      if (typeof value !== 'object' ||
                          !value ||
                          value.resources === void 0) {
                          continue;
                      }
                      if (!addAPIProvider(key, value)) {
                          console.error(err);
                      }
                  }
                  catch (e) {
                      console.error(err);
                  }
              }
          }
      }
  }
  /**
   * Internal API
   */
  var _api = {
      getAPIConfig: getAPIConfig,
      setAPIModule: setAPIModule,
      sendAPIQuery: sendAPIQuery,
      setFetch: setFetch,
      getFetch: getFetch,
      listAPIProviders: listAPIProviders,
      mergeParams: mergeParams,
  };
  /**
   * Global variable
   */
  var Iconify = {
      // IconifyAPIInternalFunctions
      _api: _api,
      // IconifyAPIFunctions
      addAPIProvider: addAPIProvider,
      loadIcons: loadIcons,
      loadIcon: loadIcon,
      // IconifyStorageFunctions
      iconExists: iconExists,
      getIcon: getIcon,
      listIcons: listIcons,
      addIcon: addIcon,
      addCollection: addCollection,
      shareStorage: shareStorage,
      // IconifyBuilderFunctions
      replaceIDs: replaceIDs,
      calculateSize: calculateSize,
      buildIcon: buildIcon,
      // IconifyCommonFunctions
      getVersion: getVersion,
      renderSVG: renderSVG,
      renderHTML: renderHTML,
      renderIcon: renderIcon,
      scan: scan,
      observe: observe,
      stopObserving: stopObserving,
      pauseObserver: pauseObserver,
      resumeObserver: resumeObserver,
      // IconifyBrowserCacheFunctions
      enableCache: enableCache,
      disableCache: disableCache,
  };

  exports._api = _api;
  exports.addAPIProvider = addAPIProvider;
  exports.addCollection = addCollection;
  exports.addIcon = addIcon;
  exports.buildIcon = buildIcon;
  exports.calculateSize = calculateSize;
  exports["default"] = Iconify;
  exports.disableCache = disableCache;
  exports.enableCache = enableCache;
  exports.getIcon = getIcon;
  exports.getVersion = getVersion;
  exports.iconExists = iconExists;
  exports.listIcons = listIcons;
  exports.loadIcon = loadIcon;
  exports.loadIcons = loadIcons;
  exports.observe = observe;
  exports.pauseObserver = pauseObserver;
  exports.renderHTML = renderHTML;
  exports.renderIcon = renderIcon;
  exports.renderSVG = renderSVG;
  exports.replaceIDs = replaceIDs;
  exports.resumeObserver = resumeObserver;
  exports.scan = scan;
  exports.shareStorage = shareStorage;
  exports.stopObserving = stopObserving;

  Object.defineProperty(exports, '__esModule', { value: true });

  return exports;

})({});

// Export as ES module
if (true) {
	try {
		exports.__esModule = true;
		exports["default"] = Iconify;
		for (var key in Iconify) {
			exports[key] = Iconify[key];
		}
	} catch (err) {
	}
}


// Export to window or web worker
try {
	if (self.Iconify === void 0) {
		self.Iconify = Iconify;
	}
} catch (err) {
}


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! @iconify/iconify/dist/iconify.js */ "./node_modules/@iconify/iconify/dist/iconify.js");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;