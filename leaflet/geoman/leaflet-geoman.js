"use strict";
(() => {
  var __create = Object.create;
  var __defProp = Object.defineProperty;
  var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
  var __getOwnPropNames = Object.getOwnPropertyNames;
  var __getProtoOf = Object.getPrototypeOf;
  var __hasOwnProp = Object.prototype.hasOwnProperty;
  var __commonJS = (cb, mod) => function __require() {
    try {
      return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
    } catch (e) {
      throw mod = 0, e;
    }
  };
  var __copyProps = (to, from, except, desc) => {
    if (from && typeof from === "object" || typeof from === "function") {
      for (let key of __getOwnPropNames(from))
        if (!__hasOwnProp.call(to, key) && key !== except)
          __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
    }
    return to;
  };
  var __toESM = (mod, isNodeMode, target) => (target = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
    // If the importer is in node compatibility mode or this is not an ESM
    // file that has been converted to a CommonJS file using a Babel-
    // compatible transform (i.e. "__esModule" has not been set), then set
    // "default" to the CommonJS "module.exports" for node compatibility.
    isNodeMode || !mod || !mod.__esModule ? __defProp(target, "default", { value: mod, enumerable: true }) : target,
    mod
  ));

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheClear.js
  var require_listCacheClear = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheClear.js"(exports, module) {
      function listCacheClear() {
        this.__data__ = [];
        this.size = 0;
      }
      module.exports = listCacheClear;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/eq.js
  var require_eq = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/eq.js"(exports, module) {
      function eq(value, other) {
        return value === other || value !== value && other !== other;
      }
      module.exports = eq;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assocIndexOf.js
  var require_assocIndexOf = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assocIndexOf.js"(exports, module) {
      var eq = require_eq();
      function assocIndexOf(array, key) {
        var length2 = array.length;
        while (length2--) {
          if (eq(array[length2][0], key)) {
            return length2;
          }
        }
        return -1;
      }
      module.exports = assocIndexOf;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheDelete.js
  var require_listCacheDelete = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheDelete.js"(exports, module) {
      var assocIndexOf = require_assocIndexOf();
      var arrayProto = Array.prototype;
      var splice = arrayProto.splice;
      function listCacheDelete(key) {
        var data = this.__data__, index = assocIndexOf(data, key);
        if (index < 0) {
          return false;
        }
        var lastIndex = data.length - 1;
        if (index == lastIndex) {
          data.pop();
        } else {
          splice.call(data, index, 1);
        }
        --this.size;
        return true;
      }
      module.exports = listCacheDelete;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheGet.js
  var require_listCacheGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheGet.js"(exports, module) {
      var assocIndexOf = require_assocIndexOf();
      function listCacheGet(key) {
        var data = this.__data__, index = assocIndexOf(data, key);
        return index < 0 ? void 0 : data[index][1];
      }
      module.exports = listCacheGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheHas.js
  var require_listCacheHas = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheHas.js"(exports, module) {
      var assocIndexOf = require_assocIndexOf();
      function listCacheHas(key) {
        return assocIndexOf(this.__data__, key) > -1;
      }
      module.exports = listCacheHas;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheSet.js
  var require_listCacheSet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_listCacheSet.js"(exports, module) {
      var assocIndexOf = require_assocIndexOf();
      function listCacheSet(key, value) {
        var data = this.__data__, index = assocIndexOf(data, key);
        if (index < 0) {
          ++this.size;
          data.push([key, value]);
        } else {
          data[index][1] = value;
        }
        return this;
      }
      module.exports = listCacheSet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_ListCache.js
  var require_ListCache = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_ListCache.js"(exports, module) {
      var listCacheClear = require_listCacheClear();
      var listCacheDelete = require_listCacheDelete();
      var listCacheGet = require_listCacheGet();
      var listCacheHas = require_listCacheHas();
      var listCacheSet = require_listCacheSet();
      function ListCache(entries) {
        var index = -1, length2 = entries == null ? 0 : entries.length;
        this.clear();
        while (++index < length2) {
          var entry = entries[index];
          this.set(entry[0], entry[1]);
        }
      }
      ListCache.prototype.clear = listCacheClear;
      ListCache.prototype["delete"] = listCacheDelete;
      ListCache.prototype.get = listCacheGet;
      ListCache.prototype.has = listCacheHas;
      ListCache.prototype.set = listCacheSet;
      module.exports = ListCache;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackClear.js
  var require_stackClear = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackClear.js"(exports, module) {
      var ListCache = require_ListCache();
      function stackClear() {
        this.__data__ = new ListCache();
        this.size = 0;
      }
      module.exports = stackClear;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackDelete.js
  var require_stackDelete = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackDelete.js"(exports, module) {
      function stackDelete(key) {
        var data = this.__data__, result = data["delete"](key);
        this.size = data.size;
        return result;
      }
      module.exports = stackDelete;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackGet.js
  var require_stackGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackGet.js"(exports, module) {
      function stackGet(key) {
        return this.__data__.get(key);
      }
      module.exports = stackGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackHas.js
  var require_stackHas = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackHas.js"(exports, module) {
      function stackHas(key) {
        return this.__data__.has(key);
      }
      module.exports = stackHas;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_freeGlobal.js
  var require_freeGlobal = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_freeGlobal.js"(exports, module) {
      var freeGlobal = typeof global == "object" && global && global.Object === Object && global;
      module.exports = freeGlobal;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_root.js
  var require_root = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_root.js"(exports, module) {
      var freeGlobal = require_freeGlobal();
      var freeSelf = typeof self == "object" && self && self.Object === Object && self;
      var root = freeGlobal || freeSelf || Function("return this")();
      module.exports = root;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Symbol.js
  var require_Symbol = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Symbol.js"(exports, module) {
      var root = require_root();
      var Symbol2 = root.Symbol;
      module.exports = Symbol2;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getRawTag.js
  var require_getRawTag = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getRawTag.js"(exports, module) {
      var Symbol2 = require_Symbol();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      var nativeObjectToString = objectProto.toString;
      var symToStringTag = Symbol2 ? Symbol2.toStringTag : void 0;
      function getRawTag(value) {
        var isOwn = hasOwnProperty.call(value, symToStringTag), tag = value[symToStringTag];
        try {
          value[symToStringTag] = void 0;
          var unmasked = true;
        } catch (e) {
        }
        var result = nativeObjectToString.call(value);
        if (unmasked) {
          if (isOwn) {
            value[symToStringTag] = tag;
          } else {
            delete value[symToStringTag];
          }
        }
        return result;
      }
      module.exports = getRawTag;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_objectToString.js
  var require_objectToString = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_objectToString.js"(exports, module) {
      var objectProto = Object.prototype;
      var nativeObjectToString = objectProto.toString;
      function objectToString(value) {
        return nativeObjectToString.call(value);
      }
      module.exports = objectToString;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseGetTag.js
  var require_baseGetTag = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseGetTag.js"(exports, module) {
      var Symbol2 = require_Symbol();
      var getRawTag = require_getRawTag();
      var objectToString = require_objectToString();
      var nullTag = "[object Null]";
      var undefinedTag = "[object Undefined]";
      var symToStringTag = Symbol2 ? Symbol2.toStringTag : void 0;
      function baseGetTag(value) {
        if (value == null) {
          return value === void 0 ? undefinedTag : nullTag;
        }
        return symToStringTag && symToStringTag in Object(value) ? getRawTag(value) : objectToString(value);
      }
      module.exports = baseGetTag;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isObject.js
  var require_isObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isObject.js"(exports, module) {
      function isObject2(value) {
        var type = typeof value;
        return value != null && (type == "object" || type == "function");
      }
      module.exports = isObject2;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isFunction.js
  var require_isFunction = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isFunction.js"(exports, module) {
      var baseGetTag = require_baseGetTag();
      var isObject2 = require_isObject();
      var asyncTag = "[object AsyncFunction]";
      var funcTag = "[object Function]";
      var genTag = "[object GeneratorFunction]";
      var proxyTag = "[object Proxy]";
      function isFunction(value) {
        if (!isObject2(value)) {
          return false;
        }
        var tag = baseGetTag(value);
        return tag == funcTag || tag == genTag || tag == asyncTag || tag == proxyTag;
      }
      module.exports = isFunction;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_coreJsData.js
  var require_coreJsData = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_coreJsData.js"(exports, module) {
      var root = require_root();
      var coreJsData = root["__core-js_shared__"];
      module.exports = coreJsData;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isMasked.js
  var require_isMasked = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isMasked.js"(exports, module) {
      var coreJsData = require_coreJsData();
      var maskSrcKey = (function() {
        var uid = /[^.]+$/.exec(coreJsData && coreJsData.keys && coreJsData.keys.IE_PROTO || "");
        return uid ? "Symbol(src)_1." + uid : "";
      })();
      function isMasked(func) {
        return !!maskSrcKey && maskSrcKey in func;
      }
      module.exports = isMasked;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_toSource.js
  var require_toSource = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_toSource.js"(exports, module) {
      var funcProto = Function.prototype;
      var funcToString = funcProto.toString;
      function toSource(func) {
        if (func != null) {
          try {
            return funcToString.call(func);
          } catch (e) {
          }
          try {
            return func + "";
          } catch (e) {
          }
        }
        return "";
      }
      module.exports = toSource;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsNative.js
  var require_baseIsNative = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsNative.js"(exports, module) {
      var isFunction = require_isFunction();
      var isMasked = require_isMasked();
      var isObject2 = require_isObject();
      var toSource = require_toSource();
      var reRegExpChar = /[\\^$.*+?()[\]{}|]/g;
      var reIsHostCtor = /^\[object .+?Constructor\]$/;
      var funcProto = Function.prototype;
      var objectProto = Object.prototype;
      var funcToString = funcProto.toString;
      var hasOwnProperty = objectProto.hasOwnProperty;
      var reIsNative = RegExp(
        "^" + funcToString.call(hasOwnProperty).replace(reRegExpChar, "\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g, "$1.*?") + "$"
      );
      function baseIsNative(value) {
        if (!isObject2(value) || isMasked(value)) {
          return false;
        }
        var pattern = isFunction(value) ? reIsNative : reIsHostCtor;
        return pattern.test(toSource(value));
      }
      module.exports = baseIsNative;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getValue.js
  var require_getValue = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getValue.js"(exports, module) {
      function getValue(object, key) {
        return object == null ? void 0 : object[key];
      }
      module.exports = getValue;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getNative.js
  var require_getNative = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getNative.js"(exports, module) {
      var baseIsNative = require_baseIsNative();
      var getValue = require_getValue();
      function getNative(object, key) {
        var value = getValue(object, key);
        return baseIsNative(value) ? value : void 0;
      }
      module.exports = getNative;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Map.js
  var require_Map = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Map.js"(exports, module) {
      var getNative = require_getNative();
      var root = require_root();
      var Map3 = getNative(root, "Map");
      module.exports = Map3;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nativeCreate.js
  var require_nativeCreate = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nativeCreate.js"(exports, module) {
      var getNative = require_getNative();
      var nativeCreate = getNative(Object, "create");
      module.exports = nativeCreate;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashClear.js
  var require_hashClear = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashClear.js"(exports, module) {
      var nativeCreate = require_nativeCreate();
      function hashClear() {
        this.__data__ = nativeCreate ? nativeCreate(null) : {};
        this.size = 0;
      }
      module.exports = hashClear;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashDelete.js
  var require_hashDelete = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashDelete.js"(exports, module) {
      function hashDelete(key) {
        var result = this.has(key) && delete this.__data__[key];
        this.size -= result ? 1 : 0;
        return result;
      }
      module.exports = hashDelete;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashGet.js
  var require_hashGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashGet.js"(exports, module) {
      var nativeCreate = require_nativeCreate();
      var HASH_UNDEFINED = "__lodash_hash_undefined__";
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      function hashGet(key) {
        var data = this.__data__;
        if (nativeCreate) {
          var result = data[key];
          return result === HASH_UNDEFINED ? void 0 : result;
        }
        return hasOwnProperty.call(data, key) ? data[key] : void 0;
      }
      module.exports = hashGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashHas.js
  var require_hashHas = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashHas.js"(exports, module) {
      var nativeCreate = require_nativeCreate();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      function hashHas(key) {
        var data = this.__data__;
        return nativeCreate ? data[key] !== void 0 : hasOwnProperty.call(data, key);
      }
      module.exports = hashHas;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashSet.js
  var require_hashSet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_hashSet.js"(exports, module) {
      var nativeCreate = require_nativeCreate();
      var HASH_UNDEFINED = "__lodash_hash_undefined__";
      function hashSet(key, value) {
        var data = this.__data__;
        this.size += this.has(key) ? 0 : 1;
        data[key] = nativeCreate && value === void 0 ? HASH_UNDEFINED : value;
        return this;
      }
      module.exports = hashSet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Hash.js
  var require_Hash = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Hash.js"(exports, module) {
      var hashClear = require_hashClear();
      var hashDelete = require_hashDelete();
      var hashGet = require_hashGet();
      var hashHas = require_hashHas();
      var hashSet = require_hashSet();
      function Hash(entries) {
        var index = -1, length2 = entries == null ? 0 : entries.length;
        this.clear();
        while (++index < length2) {
          var entry = entries[index];
          this.set(entry[0], entry[1]);
        }
      }
      Hash.prototype.clear = hashClear;
      Hash.prototype["delete"] = hashDelete;
      Hash.prototype.get = hashGet;
      Hash.prototype.has = hashHas;
      Hash.prototype.set = hashSet;
      module.exports = Hash;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheClear.js
  var require_mapCacheClear = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheClear.js"(exports, module) {
      var Hash = require_Hash();
      var ListCache = require_ListCache();
      var Map3 = require_Map();
      function mapCacheClear() {
        this.size = 0;
        this.__data__ = {
          "hash": new Hash(),
          "map": new (Map3 || ListCache)(),
          "string": new Hash()
        };
      }
      module.exports = mapCacheClear;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isKeyable.js
  var require_isKeyable = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isKeyable.js"(exports, module) {
      function isKeyable(value) {
        var type = typeof value;
        return type == "string" || type == "number" || type == "symbol" || type == "boolean" ? value !== "__proto__" : value === null;
      }
      module.exports = isKeyable;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getMapData.js
  var require_getMapData = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getMapData.js"(exports, module) {
      var isKeyable = require_isKeyable();
      function getMapData(map, key) {
        var data = map.__data__;
        return isKeyable(key) ? data[typeof key == "string" ? "string" : "hash"] : data.map;
      }
      module.exports = getMapData;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheDelete.js
  var require_mapCacheDelete = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheDelete.js"(exports, module) {
      var getMapData = require_getMapData();
      function mapCacheDelete(key) {
        var result = getMapData(this, key)["delete"](key);
        this.size -= result ? 1 : 0;
        return result;
      }
      module.exports = mapCacheDelete;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheGet.js
  var require_mapCacheGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheGet.js"(exports, module) {
      var getMapData = require_getMapData();
      function mapCacheGet(key) {
        return getMapData(this, key).get(key);
      }
      module.exports = mapCacheGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheHas.js
  var require_mapCacheHas = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheHas.js"(exports, module) {
      var getMapData = require_getMapData();
      function mapCacheHas(key) {
        return getMapData(this, key).has(key);
      }
      module.exports = mapCacheHas;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheSet.js
  var require_mapCacheSet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_mapCacheSet.js"(exports, module) {
      var getMapData = require_getMapData();
      function mapCacheSet(key, value) {
        var data = getMapData(this, key), size = data.size;
        data.set(key, value);
        this.size += data.size == size ? 0 : 1;
        return this;
      }
      module.exports = mapCacheSet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_MapCache.js
  var require_MapCache = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_MapCache.js"(exports, module) {
      var mapCacheClear = require_mapCacheClear();
      var mapCacheDelete = require_mapCacheDelete();
      var mapCacheGet = require_mapCacheGet();
      var mapCacheHas = require_mapCacheHas();
      var mapCacheSet = require_mapCacheSet();
      function MapCache(entries) {
        var index = -1, length2 = entries == null ? 0 : entries.length;
        this.clear();
        while (++index < length2) {
          var entry = entries[index];
          this.set(entry[0], entry[1]);
        }
      }
      MapCache.prototype.clear = mapCacheClear;
      MapCache.prototype["delete"] = mapCacheDelete;
      MapCache.prototype.get = mapCacheGet;
      MapCache.prototype.has = mapCacheHas;
      MapCache.prototype.set = mapCacheSet;
      module.exports = MapCache;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackSet.js
  var require_stackSet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stackSet.js"(exports, module) {
      var ListCache = require_ListCache();
      var Map3 = require_Map();
      var MapCache = require_MapCache();
      var LARGE_ARRAY_SIZE = 200;
      function stackSet(key, value) {
        var data = this.__data__;
        if (data instanceof ListCache) {
          var pairs = data.__data__;
          if (!Map3 || pairs.length < LARGE_ARRAY_SIZE - 1) {
            pairs.push([key, value]);
            this.size = ++data.size;
            return this;
          }
          data = this.__data__ = new MapCache(pairs);
        }
        data.set(key, value);
        this.size = data.size;
        return this;
      }
      module.exports = stackSet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Stack.js
  var require_Stack = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Stack.js"(exports, module) {
      var ListCache = require_ListCache();
      var stackClear = require_stackClear();
      var stackDelete = require_stackDelete();
      var stackGet = require_stackGet();
      var stackHas = require_stackHas();
      var stackSet = require_stackSet();
      function Stack(entries) {
        var data = this.__data__ = new ListCache(entries);
        this.size = data.size;
      }
      Stack.prototype.clear = stackClear;
      Stack.prototype["delete"] = stackDelete;
      Stack.prototype.get = stackGet;
      Stack.prototype.has = stackHas;
      Stack.prototype.set = stackSet;
      module.exports = Stack;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_defineProperty.js
  var require_defineProperty = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_defineProperty.js"(exports, module) {
      var getNative = require_getNative();
      var defineProperty = (function() {
        try {
          var func = getNative(Object, "defineProperty");
          func({}, "", {});
          return func;
        } catch (e) {
        }
      })();
      module.exports = defineProperty;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseAssignValue.js
  var require_baseAssignValue = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseAssignValue.js"(exports, module) {
      var defineProperty = require_defineProperty();
      function baseAssignValue(object, key, value) {
        if (key == "__proto__" && defineProperty) {
          defineProperty(object, key, {
            "configurable": true,
            "enumerable": true,
            "value": value,
            "writable": true
          });
        } else {
          object[key] = value;
        }
      }
      module.exports = baseAssignValue;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assignMergeValue.js
  var require_assignMergeValue = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assignMergeValue.js"(exports, module) {
      var baseAssignValue = require_baseAssignValue();
      var eq = require_eq();
      function assignMergeValue(object, key, value) {
        if (value !== void 0 && !eq(object[key], value) || value === void 0 && !(key in object)) {
          baseAssignValue(object, key, value);
        }
      }
      module.exports = assignMergeValue;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_createBaseFor.js
  var require_createBaseFor = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_createBaseFor.js"(exports, module) {
      function createBaseFor(fromRight) {
        return function(object, iteratee, keysFunc) {
          var index = -1, iterable = Object(object), props = keysFunc(object), length2 = props.length;
          while (length2--) {
            var key = props[fromRight ? length2 : ++index];
            if (iteratee(iterable[key], key, iterable) === false) {
              break;
            }
          }
          return object;
        };
      }
      module.exports = createBaseFor;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseFor.js
  var require_baseFor = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseFor.js"(exports, module) {
      var createBaseFor = require_createBaseFor();
      var baseFor = createBaseFor();
      module.exports = baseFor;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneBuffer.js
  var require_cloneBuffer = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneBuffer.js"(exports, module) {
      var root = require_root();
      var freeExports = typeof exports == "object" && exports && !exports.nodeType && exports;
      var freeModule = freeExports && typeof module == "object" && module && !module.nodeType && module;
      var moduleExports = freeModule && freeModule.exports === freeExports;
      var Buffer2 = moduleExports ? root.Buffer : void 0;
      var allocUnsafe = Buffer2 ? Buffer2.allocUnsafe : void 0;
      function cloneBuffer(buffer, isDeep) {
        if (isDeep) {
          return buffer.slice();
        }
        var length2 = buffer.length, result = allocUnsafe ? allocUnsafe(length2) : new buffer.constructor(length2);
        buffer.copy(result);
        return result;
      }
      module.exports = cloneBuffer;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Uint8Array.js
  var require_Uint8Array = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_Uint8Array.js"(exports, module) {
      var root = require_root();
      var Uint8Array2 = root.Uint8Array;
      module.exports = Uint8Array2;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneArrayBuffer.js
  var require_cloneArrayBuffer = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneArrayBuffer.js"(exports, module) {
      var Uint8Array2 = require_Uint8Array();
      function cloneArrayBuffer(arrayBuffer) {
        var result = new arrayBuffer.constructor(arrayBuffer.byteLength);
        new Uint8Array2(result).set(new Uint8Array2(arrayBuffer));
        return result;
      }
      module.exports = cloneArrayBuffer;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneTypedArray.js
  var require_cloneTypedArray = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_cloneTypedArray.js"(exports, module) {
      var cloneArrayBuffer = require_cloneArrayBuffer();
      function cloneTypedArray(typedArray, isDeep) {
        var buffer = isDeep ? cloneArrayBuffer(typedArray.buffer) : typedArray.buffer;
        return new typedArray.constructor(buffer, typedArray.byteOffset, typedArray.length);
      }
      module.exports = cloneTypedArray;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_copyArray.js
  var require_copyArray = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_copyArray.js"(exports, module) {
      function copyArray(source, array) {
        var index = -1, length2 = source.length;
        array || (array = Array(length2));
        while (++index < length2) {
          array[index] = source[index];
        }
        return array;
      }
      module.exports = copyArray;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseCreate.js
  var require_baseCreate = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseCreate.js"(exports, module) {
      var isObject2 = require_isObject();
      var objectCreate = Object.create;
      var baseCreate = /* @__PURE__ */ (function() {
        function object() {
        }
        return function(proto) {
          if (!isObject2(proto)) {
            return {};
          }
          if (objectCreate) {
            return objectCreate(proto);
          }
          object.prototype = proto;
          var result = new object();
          object.prototype = void 0;
          return result;
        };
      })();
      module.exports = baseCreate;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_overArg.js
  var require_overArg = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_overArg.js"(exports, module) {
      function overArg(func, transform) {
        return function(arg) {
          return func(transform(arg));
        };
      }
      module.exports = overArg;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getPrototype.js
  var require_getPrototype = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_getPrototype.js"(exports, module) {
      var overArg = require_overArg();
      var getPrototype = overArg(Object.getPrototypeOf, Object);
      module.exports = getPrototype;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isPrototype.js
  var require_isPrototype = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isPrototype.js"(exports, module) {
      var objectProto = Object.prototype;
      function isPrototype(value) {
        var Ctor = value && value.constructor, proto = typeof Ctor == "function" && Ctor.prototype || objectProto;
        return value === proto;
      }
      module.exports = isPrototype;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_initCloneObject.js
  var require_initCloneObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_initCloneObject.js"(exports, module) {
      var baseCreate = require_baseCreate();
      var getPrototype = require_getPrototype();
      var isPrototype = require_isPrototype();
      function initCloneObject(object) {
        return typeof object.constructor == "function" && !isPrototype(object) ? baseCreate(getPrototype(object)) : {};
      }
      module.exports = initCloneObject;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isObjectLike.js
  var require_isObjectLike = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isObjectLike.js"(exports, module) {
      function isObjectLike(value) {
        return value != null && typeof value == "object";
      }
      module.exports = isObjectLike;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsArguments.js
  var require_baseIsArguments = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsArguments.js"(exports, module) {
      var baseGetTag = require_baseGetTag();
      var isObjectLike = require_isObjectLike();
      var argsTag = "[object Arguments]";
      function baseIsArguments(value) {
        return isObjectLike(value) && baseGetTag(value) == argsTag;
      }
      module.exports = baseIsArguments;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArguments.js
  var require_isArguments = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArguments.js"(exports, module) {
      var baseIsArguments = require_baseIsArguments();
      var isObjectLike = require_isObjectLike();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      var propertyIsEnumerable = objectProto.propertyIsEnumerable;
      var isArguments = baseIsArguments(/* @__PURE__ */ (function() {
        return arguments;
      })()) ? baseIsArguments : function(value) {
        return isObjectLike(value) && hasOwnProperty.call(value, "callee") && !propertyIsEnumerable.call(value, "callee");
      };
      module.exports = isArguments;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArray.js
  var require_isArray = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArray.js"(exports, module) {
      var isArray = Array.isArray;
      module.exports = isArray;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isLength.js
  var require_isLength = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isLength.js"(exports, module) {
      var MAX_SAFE_INTEGER2 = 9007199254740991;
      function isLength(value) {
        return typeof value == "number" && value > -1 && value % 1 == 0 && value <= MAX_SAFE_INTEGER2;
      }
      module.exports = isLength;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArrayLike.js
  var require_isArrayLike = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArrayLike.js"(exports, module) {
      var isFunction = require_isFunction();
      var isLength = require_isLength();
      function isArrayLike(value) {
        return value != null && isLength(value.length) && !isFunction(value);
      }
      module.exports = isArrayLike;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArrayLikeObject.js
  var require_isArrayLikeObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isArrayLikeObject.js"(exports, module) {
      var isArrayLike = require_isArrayLike();
      var isObjectLike = require_isObjectLike();
      function isArrayLikeObject(value) {
        return isObjectLike(value) && isArrayLike(value);
      }
      module.exports = isArrayLikeObject;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/stubFalse.js
  var require_stubFalse = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/stubFalse.js"(exports, module) {
      function stubFalse() {
        return false;
      }
      module.exports = stubFalse;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isBuffer.js
  var require_isBuffer = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isBuffer.js"(exports, module) {
      var root = require_root();
      var stubFalse = require_stubFalse();
      var freeExports = typeof exports == "object" && exports && !exports.nodeType && exports;
      var freeModule = freeExports && typeof module == "object" && module && !module.nodeType && module;
      var moduleExports = freeModule && freeModule.exports === freeExports;
      var Buffer2 = moduleExports ? root.Buffer : void 0;
      var nativeIsBuffer = Buffer2 ? Buffer2.isBuffer : void 0;
      var isBuffer = nativeIsBuffer || stubFalse;
      module.exports = isBuffer;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isPlainObject.js
  var require_isPlainObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isPlainObject.js"(exports, module) {
      var baseGetTag = require_baseGetTag();
      var getPrototype = require_getPrototype();
      var isObjectLike = require_isObjectLike();
      var objectTag = "[object Object]";
      var funcProto = Function.prototype;
      var objectProto = Object.prototype;
      var funcToString = funcProto.toString;
      var hasOwnProperty = objectProto.hasOwnProperty;
      var objectCtorString = funcToString.call(Object);
      function isPlainObject(value) {
        if (!isObjectLike(value) || baseGetTag(value) != objectTag) {
          return false;
        }
        var proto = getPrototype(value);
        if (proto === null) {
          return true;
        }
        var Ctor = hasOwnProperty.call(proto, "constructor") && proto.constructor;
        return typeof Ctor == "function" && Ctor instanceof Ctor && funcToString.call(Ctor) == objectCtorString;
      }
      module.exports = isPlainObject;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsTypedArray.js
  var require_baseIsTypedArray = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseIsTypedArray.js"(exports, module) {
      var baseGetTag = require_baseGetTag();
      var isLength = require_isLength();
      var isObjectLike = require_isObjectLike();
      var argsTag = "[object Arguments]";
      var arrayTag = "[object Array]";
      var boolTag = "[object Boolean]";
      var dateTag = "[object Date]";
      var errorTag = "[object Error]";
      var funcTag = "[object Function]";
      var mapTag = "[object Map]";
      var numberTag = "[object Number]";
      var objectTag = "[object Object]";
      var regexpTag = "[object RegExp]";
      var setTag = "[object Set]";
      var stringTag = "[object String]";
      var weakMapTag = "[object WeakMap]";
      var arrayBufferTag = "[object ArrayBuffer]";
      var dataViewTag = "[object DataView]";
      var float32Tag = "[object Float32Array]";
      var float64Tag = "[object Float64Array]";
      var int8Tag = "[object Int8Array]";
      var int16Tag = "[object Int16Array]";
      var int32Tag = "[object Int32Array]";
      var uint8Tag = "[object Uint8Array]";
      var uint8ClampedTag = "[object Uint8ClampedArray]";
      var uint16Tag = "[object Uint16Array]";
      var uint32Tag = "[object Uint32Array]";
      var typedArrayTags = {};
      typedArrayTags[float32Tag] = typedArrayTags[float64Tag] = typedArrayTags[int8Tag] = typedArrayTags[int16Tag] = typedArrayTags[int32Tag] = typedArrayTags[uint8Tag] = typedArrayTags[uint8ClampedTag] = typedArrayTags[uint16Tag] = typedArrayTags[uint32Tag] = true;
      typedArrayTags[argsTag] = typedArrayTags[arrayTag] = typedArrayTags[arrayBufferTag] = typedArrayTags[boolTag] = typedArrayTags[dataViewTag] = typedArrayTags[dateTag] = typedArrayTags[errorTag] = typedArrayTags[funcTag] = typedArrayTags[mapTag] = typedArrayTags[numberTag] = typedArrayTags[objectTag] = typedArrayTags[regexpTag] = typedArrayTags[setTag] = typedArrayTags[stringTag] = typedArrayTags[weakMapTag] = false;
      function baseIsTypedArray(value) {
        return isObjectLike(value) && isLength(value.length) && !!typedArrayTags[baseGetTag(value)];
      }
      module.exports = baseIsTypedArray;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseUnary.js
  var require_baseUnary = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseUnary.js"(exports, module) {
      function baseUnary(func) {
        return function(value) {
          return func(value);
        };
      }
      module.exports = baseUnary;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nodeUtil.js
  var require_nodeUtil = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nodeUtil.js"(exports, module) {
      var freeGlobal = require_freeGlobal();
      var freeExports = typeof exports == "object" && exports && !exports.nodeType && exports;
      var freeModule = freeExports && typeof module == "object" && module && !module.nodeType && module;
      var moduleExports = freeModule && freeModule.exports === freeExports;
      var freeProcess = moduleExports && freeGlobal.process;
      var nodeUtil = (function() {
        try {
          var types = freeModule && freeModule.require && freeModule.require("util").types;
          if (types) {
            return types;
          }
          return freeProcess && freeProcess.binding && freeProcess.binding("util");
        } catch (e) {
        }
      })();
      module.exports = nodeUtil;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isTypedArray.js
  var require_isTypedArray = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isTypedArray.js"(exports, module) {
      var baseIsTypedArray = require_baseIsTypedArray();
      var baseUnary = require_baseUnary();
      var nodeUtil = require_nodeUtil();
      var nodeIsTypedArray = nodeUtil && nodeUtil.isTypedArray;
      var isTypedArray = nodeIsTypedArray ? baseUnary(nodeIsTypedArray) : baseIsTypedArray;
      module.exports = isTypedArray;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_safeGet.js
  var require_safeGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_safeGet.js"(exports, module) {
      function safeGet(object, key) {
        if (key === "constructor" && typeof object[key] === "function") {
          return;
        }
        if (key == "__proto__") {
          return;
        }
        return object[key];
      }
      module.exports = safeGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assignValue.js
  var require_assignValue = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_assignValue.js"(exports, module) {
      var baseAssignValue = require_baseAssignValue();
      var eq = require_eq();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      function assignValue(object, key, value) {
        var objValue = object[key];
        if (!(hasOwnProperty.call(object, key) && eq(objValue, value)) || value === void 0 && !(key in object)) {
          baseAssignValue(object, key, value);
        }
      }
      module.exports = assignValue;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_copyObject.js
  var require_copyObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_copyObject.js"(exports, module) {
      var assignValue = require_assignValue();
      var baseAssignValue = require_baseAssignValue();
      function copyObject(source, props, object, customizer) {
        var isNew = !object;
        object || (object = {});
        var index = -1, length2 = props.length;
        while (++index < length2) {
          var key = props[index];
          var newValue = customizer ? customizer(object[key], source[key], key, object, source) : void 0;
          if (newValue === void 0) {
            newValue = source[key];
          }
          if (isNew) {
            baseAssignValue(object, key, newValue);
          } else {
            assignValue(object, key, newValue);
          }
        }
        return object;
      }
      module.exports = copyObject;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseTimes.js
  var require_baseTimes = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseTimes.js"(exports, module) {
      function baseTimes(n, iteratee) {
        var index = -1, result = Array(n);
        while (++index < n) {
          result[index] = iteratee(index);
        }
        return result;
      }
      module.exports = baseTimes;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isIndex.js
  var require_isIndex = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isIndex.js"(exports, module) {
      var MAX_SAFE_INTEGER2 = 9007199254740991;
      var reIsUint = /^(?:0|[1-9]\d*)$/;
      function isIndex(value, length2) {
        var type = typeof value;
        length2 = length2 == null ? MAX_SAFE_INTEGER2 : length2;
        return !!length2 && (type == "number" || type != "symbol" && reIsUint.test(value)) && (value > -1 && value % 1 == 0 && value < length2);
      }
      module.exports = isIndex;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_arrayLikeKeys.js
  var require_arrayLikeKeys = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_arrayLikeKeys.js"(exports, module) {
      var baseTimes = require_baseTimes();
      var isArguments = require_isArguments();
      var isArray = require_isArray();
      var isBuffer = require_isBuffer();
      var isIndex = require_isIndex();
      var isTypedArray = require_isTypedArray();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      function arrayLikeKeys(value, inherited) {
        var isArr = isArray(value), isArg = !isArr && isArguments(value), isBuff = !isArr && !isArg && isBuffer(value), isType = !isArr && !isArg && !isBuff && isTypedArray(value), skipIndexes = isArr || isArg || isBuff || isType, result = skipIndexes ? baseTimes(value.length, String) : [], length2 = result.length;
        for (var key in value) {
          if ((inherited || hasOwnProperty.call(value, key)) && !(skipIndexes && // Safari 9 has enumerable `arguments.length` in strict mode.
          (key == "length" || // Node.js 0.10 has enumerable non-index properties on buffers.
          isBuff && (key == "offset" || key == "parent") || // PhantomJS 2 has enumerable non-index properties on typed arrays.
          isType && (key == "buffer" || key == "byteLength" || key == "byteOffset") || // Skip index properties.
          isIndex(key, length2)))) {
            result.push(key);
          }
        }
        return result;
      }
      module.exports = arrayLikeKeys;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nativeKeysIn.js
  var require_nativeKeysIn = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_nativeKeysIn.js"(exports, module) {
      function nativeKeysIn(object) {
        var result = [];
        if (object != null) {
          for (var key in Object(object)) {
            result.push(key);
          }
        }
        return result;
      }
      module.exports = nativeKeysIn;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseKeysIn.js
  var require_baseKeysIn = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseKeysIn.js"(exports, module) {
      var isObject2 = require_isObject();
      var isPrototype = require_isPrototype();
      var nativeKeysIn = require_nativeKeysIn();
      var objectProto = Object.prototype;
      var hasOwnProperty = objectProto.hasOwnProperty;
      function baseKeysIn(object) {
        if (!isObject2(object)) {
          return nativeKeysIn(object);
        }
        var isProto = isPrototype(object), result = [];
        for (var key in object) {
          if (!(key == "constructor" && (isProto || !hasOwnProperty.call(object, key)))) {
            result.push(key);
          }
        }
        return result;
      }
      module.exports = baseKeysIn;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/keysIn.js
  var require_keysIn = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/keysIn.js"(exports, module) {
      var arrayLikeKeys = require_arrayLikeKeys();
      var baseKeysIn = require_baseKeysIn();
      var isArrayLike = require_isArrayLike();
      function keysIn(object) {
        return isArrayLike(object) ? arrayLikeKeys(object, true) : baseKeysIn(object);
      }
      module.exports = keysIn;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/toPlainObject.js
  var require_toPlainObject = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/toPlainObject.js"(exports, module) {
      var copyObject = require_copyObject();
      var keysIn = require_keysIn();
      function toPlainObject(value) {
        return copyObject(value, keysIn(value));
      }
      module.exports = toPlainObject;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseMergeDeep.js
  var require_baseMergeDeep = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseMergeDeep.js"(exports, module) {
      var assignMergeValue = require_assignMergeValue();
      var cloneBuffer = require_cloneBuffer();
      var cloneTypedArray = require_cloneTypedArray();
      var copyArray = require_copyArray();
      var initCloneObject = require_initCloneObject();
      var isArguments = require_isArguments();
      var isArray = require_isArray();
      var isArrayLikeObject = require_isArrayLikeObject();
      var isBuffer = require_isBuffer();
      var isFunction = require_isFunction();
      var isObject2 = require_isObject();
      var isPlainObject = require_isPlainObject();
      var isTypedArray = require_isTypedArray();
      var safeGet = require_safeGet();
      var toPlainObject = require_toPlainObject();
      function baseMergeDeep(object, source, key, srcIndex, mergeFunc, customizer, stack) {
        var objValue = safeGet(object, key), srcValue = safeGet(source, key), stacked = stack.get(srcValue);
        if (stacked) {
          assignMergeValue(object, key, stacked);
          return;
        }
        var newValue = customizer ? customizer(objValue, srcValue, key + "", object, source, stack) : void 0;
        var isCommon = newValue === void 0;
        if (isCommon) {
          var isArr = isArray(srcValue), isBuff = !isArr && isBuffer(srcValue), isTyped = !isArr && !isBuff && isTypedArray(srcValue);
          newValue = srcValue;
          if (isArr || isBuff || isTyped) {
            if (isArray(objValue)) {
              newValue = objValue;
            } else if (isArrayLikeObject(objValue)) {
              newValue = copyArray(objValue);
            } else if (isBuff) {
              isCommon = false;
              newValue = cloneBuffer(srcValue, true);
            } else if (isTyped) {
              isCommon = false;
              newValue = cloneTypedArray(srcValue, true);
            } else {
              newValue = [];
            }
          } else if (isPlainObject(srcValue) || isArguments(srcValue)) {
            newValue = objValue;
            if (isArguments(objValue)) {
              newValue = toPlainObject(objValue);
            } else if (!isObject2(objValue) || isFunction(objValue)) {
              newValue = initCloneObject(srcValue);
            }
          } else {
            isCommon = false;
          }
        }
        if (isCommon) {
          stack.set(srcValue, newValue);
          mergeFunc(newValue, srcValue, srcIndex, customizer, stack);
          stack["delete"](srcValue);
        }
        assignMergeValue(object, key, newValue);
      }
      module.exports = baseMergeDeep;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseMerge.js
  var require_baseMerge = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseMerge.js"(exports, module) {
      var Stack = require_Stack();
      var assignMergeValue = require_assignMergeValue();
      var baseFor = require_baseFor();
      var baseMergeDeep = require_baseMergeDeep();
      var isObject2 = require_isObject();
      var keysIn = require_keysIn();
      var safeGet = require_safeGet();
      function baseMerge(object, source, srcIndex, customizer, stack) {
        if (object === source) {
          return;
        }
        baseFor(source, function(srcValue, key) {
          stack || (stack = new Stack());
          if (isObject2(srcValue)) {
            baseMergeDeep(object, source, key, srcIndex, baseMerge, customizer, stack);
          } else {
            var newValue = customizer ? customizer(safeGet(object, key), srcValue, key + "", object, source, stack) : void 0;
            if (newValue === void 0) {
              newValue = srcValue;
            }
            assignMergeValue(object, key, newValue);
          }
        }, keysIn);
      }
      module.exports = baseMerge;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/identity.js
  var require_identity = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/identity.js"(exports, module) {
      function identity(value) {
        return value;
      }
      module.exports = identity;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_apply.js
  var require_apply = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_apply.js"(exports, module) {
      function apply(func, thisArg, args) {
        switch (args.length) {
          case 0:
            return func.call(thisArg);
          case 1:
            return func.call(thisArg, args[0]);
          case 2:
            return func.call(thisArg, args[0], args[1]);
          case 3:
            return func.call(thisArg, args[0], args[1], args[2]);
        }
        return func.apply(thisArg, args);
      }
      module.exports = apply;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_overRest.js
  var require_overRest = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_overRest.js"(exports, module) {
      var apply = require_apply();
      var nativeMax = Math.max;
      function overRest(func, start, transform) {
        start = nativeMax(start === void 0 ? func.length - 1 : start, 0);
        return function() {
          var args = arguments, index = -1, length2 = nativeMax(args.length - start, 0), array = Array(length2);
          while (++index < length2) {
            array[index] = args[start + index];
          }
          index = -1;
          var otherArgs = Array(start + 1);
          while (++index < start) {
            otherArgs[index] = args[index];
          }
          otherArgs[start] = transform(array);
          return apply(func, this, otherArgs);
        };
      }
      module.exports = overRest;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/constant.js
  var require_constant = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/constant.js"(exports, module) {
      function constant(value) {
        return function() {
          return value;
        };
      }
      module.exports = constant;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseSetToString.js
  var require_baseSetToString = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseSetToString.js"(exports, module) {
      var constant = require_constant();
      var defineProperty = require_defineProperty();
      var identity = require_identity();
      var baseSetToString = !defineProperty ? identity : function(func, string) {
        return defineProperty(func, "toString", {
          "configurable": true,
          "enumerable": false,
          "value": constant(string),
          "writable": true
        });
      };
      module.exports = baseSetToString;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_shortOut.js
  var require_shortOut = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_shortOut.js"(exports, module) {
      var HOT_COUNT = 800;
      var HOT_SPAN = 16;
      var nativeNow = Date.now;
      function shortOut(func) {
        var count = 0, lastCalled = 0;
        return function() {
          var stamp = nativeNow(), remaining = HOT_SPAN - (stamp - lastCalled);
          lastCalled = stamp;
          if (remaining > 0) {
            if (++count >= HOT_COUNT) {
              return arguments[0];
            }
          } else {
            count = 0;
          }
          return func.apply(void 0, arguments);
        };
      }
      module.exports = shortOut;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_setToString.js
  var require_setToString = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_setToString.js"(exports, module) {
      var baseSetToString = require_baseSetToString();
      var shortOut = require_shortOut();
      var setToString = shortOut(baseSetToString);
      module.exports = setToString;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseRest.js
  var require_baseRest = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseRest.js"(exports, module) {
      var identity = require_identity();
      var overRest = require_overRest();
      var setToString = require_setToString();
      function baseRest(func, start) {
        return setToString(overRest(func, start, identity), func + "");
      }
      module.exports = baseRest;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isIterateeCall.js
  var require_isIterateeCall = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isIterateeCall.js"(exports, module) {
      var eq = require_eq();
      var isArrayLike = require_isArrayLike();
      var isIndex = require_isIndex();
      var isObject2 = require_isObject();
      function isIterateeCall(value, index, object) {
        if (!isObject2(object)) {
          return false;
        }
        var type = typeof index;
        if (type == "number" ? isArrayLike(object) && isIndex(index, object.length) : type == "string" && index in object) {
          return eq(object[index], value);
        }
        return false;
      }
      module.exports = isIterateeCall;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_createAssigner.js
  var require_createAssigner = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_createAssigner.js"(exports, module) {
      var baseRest = require_baseRest();
      var isIterateeCall = require_isIterateeCall();
      function createAssigner(assigner) {
        return baseRest(function(object, sources) {
          var index = -1, length2 = sources.length, customizer = length2 > 1 ? sources[length2 - 1] : void 0, guard = length2 > 2 ? sources[2] : void 0;
          customizer = assigner.length > 3 && typeof customizer == "function" ? (length2--, customizer) : void 0;
          if (guard && isIterateeCall(sources[0], sources[1], guard)) {
            customizer = length2 < 3 ? void 0 : customizer;
            length2 = 1;
          }
          object = Object(object);
          while (++index < length2) {
            var source = sources[index];
            if (source) {
              assigner(object, source, index, customizer);
            }
          }
          return object;
        });
      }
      module.exports = createAssigner;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/merge.js
  var require_merge = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/merge.js"(exports, module) {
      var baseMerge = require_baseMerge();
      var createAssigner = require_createAssigner();
      var merge4 = createAssigner(function(object, source, srcIndex) {
        baseMerge(object, source, srcIndex);
      });
      module.exports = merge4;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isSymbol.js
  var require_isSymbol = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/isSymbol.js"(exports, module) {
      var baseGetTag = require_baseGetTag();
      var isObjectLike = require_isObjectLike();
      var symbolTag = "[object Symbol]";
      function isSymbol(value) {
        return typeof value == "symbol" || isObjectLike(value) && baseGetTag(value) == symbolTag;
      }
      module.exports = isSymbol;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isKey.js
  var require_isKey = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_isKey.js"(exports, module) {
      var isArray = require_isArray();
      var isSymbol = require_isSymbol();
      var reIsDeepProp = /\.|\[(?:[^[\]]*|(["'])(?:(?!\1)[^\\]|\\.)*?\1)\]/;
      var reIsPlainProp = /^\w*$/;
      function isKey(value, object) {
        if (isArray(value)) {
          return false;
        }
        var type = typeof value;
        if (type == "number" || type == "symbol" || type == "boolean" || value == null || isSymbol(value)) {
          return true;
        }
        return reIsPlainProp.test(value) || !reIsDeepProp.test(value) || object != null && value in Object(object);
      }
      module.exports = isKey;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/memoize.js
  var require_memoize = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/memoize.js"(exports, module) {
      var MapCache = require_MapCache();
      var FUNC_ERROR_TEXT = "Expected a function";
      function memoize(func, resolver) {
        if (typeof func != "function" || resolver != null && typeof resolver != "function") {
          throw new TypeError(FUNC_ERROR_TEXT);
        }
        var memoized = function() {
          var args = arguments, key = resolver ? resolver.apply(this, args) : args[0], cache = memoized.cache;
          if (cache.has(key)) {
            return cache.get(key);
          }
          var result = func.apply(this, args);
          memoized.cache = cache.set(key, result) || cache;
          return result;
        };
        memoized.cache = new (memoize.Cache || MapCache)();
        return memoized;
      }
      memoize.Cache = MapCache;
      module.exports = memoize;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_memoizeCapped.js
  var require_memoizeCapped = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_memoizeCapped.js"(exports, module) {
      var memoize = require_memoize();
      var MAX_MEMOIZE_SIZE = 500;
      function memoizeCapped(func) {
        var result = memoize(func, function(key) {
          if (cache.size === MAX_MEMOIZE_SIZE) {
            cache.clear();
          }
          return key;
        });
        var cache = result.cache;
        return result;
      }
      module.exports = memoizeCapped;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stringToPath.js
  var require_stringToPath = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_stringToPath.js"(exports, module) {
      var memoizeCapped = require_memoizeCapped();
      var rePropName = /[^.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|$))/g;
      var reEscapeChar = /\\(\\)?/g;
      var stringToPath = memoizeCapped(function(string) {
        var result = [];
        if (string.charCodeAt(0) === 46) {
          result.push("");
        }
        string.replace(rePropName, function(match, number, quote, subString) {
          result.push(quote ? subString.replace(reEscapeChar, "$1") : number || match);
        });
        return result;
      });
      module.exports = stringToPath;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_arrayMap.js
  var require_arrayMap = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_arrayMap.js"(exports, module) {
      function arrayMap(array, iteratee) {
        var index = -1, length2 = array == null ? 0 : array.length, result = Array(length2);
        while (++index < length2) {
          result[index] = iteratee(array[index], index, array);
        }
        return result;
      }
      module.exports = arrayMap;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseToString.js
  var require_baseToString = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseToString.js"(exports, module) {
      var Symbol2 = require_Symbol();
      var arrayMap = require_arrayMap();
      var isArray = require_isArray();
      var isSymbol = require_isSymbol();
      var INFINITY = 1 / 0;
      var symbolProto = Symbol2 ? Symbol2.prototype : void 0;
      var symbolToString = symbolProto ? symbolProto.toString : void 0;
      function baseToString(value) {
        if (typeof value == "string") {
          return value;
        }
        if (isArray(value)) {
          return arrayMap(value, baseToString) + "";
        }
        if (isSymbol(value)) {
          return symbolToString ? symbolToString.call(value) : "";
        }
        var result = value + "";
        return result == "0" && 1 / value == -INFINITY ? "-0" : result;
      }
      module.exports = baseToString;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/toString.js
  var require_toString = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/toString.js"(exports, module) {
      var baseToString = require_baseToString();
      function toString(value) {
        return value == null ? "" : baseToString(value);
      }
      module.exports = toString;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_castPath.js
  var require_castPath = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_castPath.js"(exports, module) {
      var isArray = require_isArray();
      var isKey = require_isKey();
      var stringToPath = require_stringToPath();
      var toString = require_toString();
      function castPath(value, object) {
        if (isArray(value)) {
          return value;
        }
        return isKey(value, object) ? [value] : stringToPath(toString(value));
      }
      module.exports = castPath;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_toKey.js
  var require_toKey = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_toKey.js"(exports, module) {
      var isSymbol = require_isSymbol();
      var INFINITY = 1 / 0;
      function toKey(value) {
        if (typeof value == "string" || isSymbol(value)) {
          return value;
        }
        var result = value + "";
        return result == "0" && 1 / value == -INFINITY ? "-0" : result;
      }
      module.exports = toKey;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseGet.js
  var require_baseGet = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/_baseGet.js"(exports, module) {
      var castPath = require_castPath();
      var toKey = require_toKey();
      function baseGet(object, path) {
        path = castPath(path, object);
        var index = 0, length2 = path.length;
        while (object != null && index < length2) {
          object = object[toKey(path[index++])];
        }
        return index && index == length2 ? object : void 0;
      }
      module.exports = baseGet;
    }
  });

  // node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/get.js
  var require_get = __commonJS({
    "node_modules/.pnpm/lodash@4.18.1/node_modules/lodash/get.js"(exports, module) {
      var baseGet = require_baseGet();
      function get5(object, path, defaultValue) {
        var result = object == null ? void 0 : baseGet(object, path);
        return result === void 0 ? defaultValue : result;
      }
      module.exports = get5;
    }
  });

  // node_modules/.pnpm/rbush@3.0.1/node_modules/rbush/rbush.min.js
  var require_rbush_min = __commonJS({
    "node_modules/.pnpm/rbush@3.0.1/node_modules/rbush/rbush.min.js"(exports, module) {
      !(function(t, i) {
        "object" == typeof exports && "undefined" != typeof module ? module.exports = i() : "function" == typeof define && define.amd ? define(i) : (t = t || self).RBush = i();
      })(exports, function() {
        "use strict";
        function t(t2, r2, e2, a2, h2) {
          !(function t3(n2, r3, e3, a3, h3) {
            for (; a3 > e3; ) {
              if (a3 - e3 > 600) {
                var o2 = a3 - e3 + 1, s2 = r3 - e3 + 1, l2 = Math.log(o2), f2 = 0.5 * Math.exp(2 * l2 / 3), u8 = 0.5 * Math.sqrt(l2 * f2 * (o2 - f2) / o2) * (s2 - o2 / 2 < 0 ? -1 : 1), m2 = Math.max(e3, Math.floor(r3 - s2 * f2 / o2 + u8)), c2 = Math.min(a3, Math.floor(r3 + (o2 - s2) * f2 / o2 + u8));
                t3(n2, r3, m2, c2, h3);
              }
              var p2 = n2[r3], d2 = e3, x = a3;
              for (i(n2, e3, r3), h3(n2[a3], p2) > 0 && i(n2, e3, a3); d2 < x; ) {
                for (i(n2, d2, x), d2++, x--; h3(n2[d2], p2) < 0; ) d2++;
                for (; h3(n2[x], p2) > 0; ) x--;
              }
              0 === h3(n2[e3], p2) ? i(n2, e3, x) : i(n2, ++x, a3), x <= r3 && (e3 = x + 1), r3 <= x && (a3 = x - 1);
            }
          })(t2, r2, e2 || 0, a2 || t2.length - 1, h2 || n);
        }
        function i(t2, i2, n2) {
          var r2 = t2[i2];
          t2[i2] = t2[n2], t2[n2] = r2;
        }
        function n(t2, i2) {
          return t2 < i2 ? -1 : t2 > i2 ? 1 : 0;
        }
        var r = function(t2) {
          void 0 === t2 && (t2 = 9), this._maxEntries = Math.max(4, t2), this._minEntries = Math.max(2, Math.ceil(0.4 * this._maxEntries)), this.clear();
        };
        function e(t2, i2, n2) {
          if (!n2) return i2.indexOf(t2);
          for (var r2 = 0; r2 < i2.length; r2++) if (n2(t2, i2[r2])) return r2;
          return -1;
        }
        function a(t2, i2) {
          h(t2, 0, t2.children.length, i2, t2);
        }
        function h(t2, i2, n2, r2, e2) {
          e2 || (e2 = p(null)), e2.minX = 1 / 0, e2.minY = 1 / 0, e2.maxX = -1 / 0, e2.maxY = -1 / 0;
          for (var a2 = i2; a2 < n2; a2++) {
            var h2 = t2.children[a2];
            o(e2, t2.leaf ? r2(h2) : h2);
          }
          return e2;
        }
        function o(t2, i2) {
          return t2.minX = Math.min(t2.minX, i2.minX), t2.minY = Math.min(t2.minY, i2.minY), t2.maxX = Math.max(t2.maxX, i2.maxX), t2.maxY = Math.max(t2.maxY, i2.maxY), t2;
        }
        function s(t2, i2) {
          return t2.minX - i2.minX;
        }
        function l(t2, i2) {
          return t2.minY - i2.minY;
        }
        function f(t2) {
          return (t2.maxX - t2.minX) * (t2.maxY - t2.minY);
        }
        function u7(t2) {
          return t2.maxX - t2.minX + (t2.maxY - t2.minY);
        }
        function m(t2, i2) {
          return t2.minX <= i2.minX && t2.minY <= i2.minY && i2.maxX <= t2.maxX && i2.maxY <= t2.maxY;
        }
        function c(t2, i2) {
          return i2.minX <= t2.maxX && i2.minY <= t2.maxY && i2.maxX >= t2.minX && i2.maxY >= t2.minY;
        }
        function p(t2) {
          return { children: t2, height: 1, leaf: true, minX: 1 / 0, minY: 1 / 0, maxX: -1 / 0, maxY: -1 / 0 };
        }
        function d(i2, n2, r2, e2, a2) {
          for (var h2 = [n2, r2]; h2.length; ) if (!((r2 = h2.pop()) - (n2 = h2.pop()) <= e2)) {
            var o2 = n2 + Math.ceil((r2 - n2) / e2 / 2) * e2;
            t(i2, o2, n2, r2, a2), h2.push(n2, o2, o2, r2);
          }
        }
        return r.prototype.all = function() {
          return this._all(this.data, []);
        }, r.prototype.search = function(t2) {
          var i2 = this.data, n2 = [];
          if (!c(t2, i2)) return n2;
          for (var r2 = this.toBBox, e2 = []; i2; ) {
            for (var a2 = 0; a2 < i2.children.length; a2++) {
              var h2 = i2.children[a2], o2 = i2.leaf ? r2(h2) : h2;
              c(t2, o2) && (i2.leaf ? n2.push(h2) : m(t2, o2) ? this._all(h2, n2) : e2.push(h2));
            }
            i2 = e2.pop();
          }
          return n2;
        }, r.prototype.collides = function(t2) {
          var i2 = this.data;
          if (!c(t2, i2)) return false;
          for (var n2 = []; i2; ) {
            for (var r2 = 0; r2 < i2.children.length; r2++) {
              var e2 = i2.children[r2], a2 = i2.leaf ? this.toBBox(e2) : e2;
              if (c(t2, a2)) {
                if (i2.leaf || m(t2, a2)) return true;
                n2.push(e2);
              }
            }
            i2 = n2.pop();
          }
          return false;
        }, r.prototype.load = function(t2) {
          if (!t2 || !t2.length) return this;
          if (t2.length < this._minEntries) {
            for (var i2 = 0; i2 < t2.length; i2++) this.insert(t2[i2]);
            return this;
          }
          var n2 = this._build(t2.slice(), 0, t2.length - 1, 0);
          if (this.data.children.length) if (this.data.height === n2.height) this._splitRoot(this.data, n2);
          else {
            if (this.data.height < n2.height) {
              var r2 = this.data;
              this.data = n2, n2 = r2;
            }
            this._insert(n2, this.data.height - n2.height - 1, true);
          }
          else this.data = n2;
          return this;
        }, r.prototype.insert = function(t2) {
          return t2 && this._insert(t2, this.data.height - 1), this;
        }, r.prototype.clear = function() {
          return this.data = p([]), this;
        }, r.prototype.remove = function(t2, i2) {
          if (!t2) return this;
          for (var n2, r2, a2, h2 = this.data, o2 = this.toBBox(t2), s2 = [], l2 = []; h2 || s2.length; ) {
            if (h2 || (h2 = s2.pop(), r2 = s2[s2.length - 1], n2 = l2.pop(), a2 = true), h2.leaf) {
              var f2 = e(t2, h2.children, i2);
              if (-1 !== f2) return h2.children.splice(f2, 1), s2.push(h2), this._condense(s2), this;
            }
            a2 || h2.leaf || !m(h2, o2) ? r2 ? (n2++, h2 = r2.children[n2], a2 = false) : h2 = null : (s2.push(h2), l2.push(n2), n2 = 0, r2 = h2, h2 = h2.children[0]);
          }
          return this;
        }, r.prototype.toBBox = function(t2) {
          return t2;
        }, r.prototype.compareMinX = function(t2, i2) {
          return t2.minX - i2.minX;
        }, r.prototype.compareMinY = function(t2, i2) {
          return t2.minY - i2.minY;
        }, r.prototype.toJSON = function() {
          return this.data;
        }, r.prototype.fromJSON = function(t2) {
          return this.data = t2, this;
        }, r.prototype._all = function(t2, i2) {
          for (var n2 = []; t2; ) t2.leaf ? i2.push.apply(i2, t2.children) : n2.push.apply(n2, t2.children), t2 = n2.pop();
          return i2;
        }, r.prototype._build = function(t2, i2, n2, r2) {
          var e2, h2 = n2 - i2 + 1, o2 = this._maxEntries;
          if (h2 <= o2) return a(e2 = p(t2.slice(i2, n2 + 1)), this.toBBox), e2;
          r2 || (r2 = Math.ceil(Math.log(h2) / Math.log(o2)), o2 = Math.ceil(h2 / Math.pow(o2, r2 - 1))), (e2 = p([])).leaf = false, e2.height = r2;
          var s2 = Math.ceil(h2 / o2), l2 = s2 * Math.ceil(Math.sqrt(o2));
          d(t2, i2, n2, l2, this.compareMinX);
          for (var f2 = i2; f2 <= n2; f2 += l2) {
            var u8 = Math.min(f2 + l2 - 1, n2);
            d(t2, f2, u8, s2, this.compareMinY);
            for (var m2 = f2; m2 <= u8; m2 += s2) {
              var c2 = Math.min(m2 + s2 - 1, u8);
              e2.children.push(this._build(t2, m2, c2, r2 - 1));
            }
          }
          return a(e2, this.toBBox), e2;
        }, r.prototype._chooseSubtree = function(t2, i2, n2, r2) {
          for (; r2.push(i2), !i2.leaf && r2.length - 1 !== n2; ) {
            for (var e2 = 1 / 0, a2 = 1 / 0, h2 = void 0, o2 = 0; o2 < i2.children.length; o2++) {
              var s2 = i2.children[o2], l2 = f(s2), u8 = (m2 = t2, c2 = s2, (Math.max(c2.maxX, m2.maxX) - Math.min(c2.minX, m2.minX)) * (Math.max(c2.maxY, m2.maxY) - Math.min(c2.minY, m2.minY)) - l2);
              u8 < a2 ? (a2 = u8, e2 = l2 < e2 ? l2 : e2, h2 = s2) : u8 === a2 && l2 < e2 && (e2 = l2, h2 = s2);
            }
            i2 = h2 || i2.children[0];
          }
          var m2, c2;
          return i2;
        }, r.prototype._insert = function(t2, i2, n2) {
          var r2 = n2 ? t2 : this.toBBox(t2), e2 = [], a2 = this._chooseSubtree(r2, this.data, i2, e2);
          for (a2.children.push(t2), o(a2, r2); i2 >= 0 && e2[i2].children.length > this._maxEntries; ) this._split(e2, i2), i2--;
          this._adjustParentBBoxes(r2, e2, i2);
        }, r.prototype._split = function(t2, i2) {
          var n2 = t2[i2], r2 = n2.children.length, e2 = this._minEntries;
          this._chooseSplitAxis(n2, e2, r2);
          var h2 = this._chooseSplitIndex(n2, e2, r2), o2 = p(n2.children.splice(h2, n2.children.length - h2));
          o2.height = n2.height, o2.leaf = n2.leaf, a(n2, this.toBBox), a(o2, this.toBBox), i2 ? t2[i2 - 1].children.push(o2) : this._splitRoot(n2, o2);
        }, r.prototype._splitRoot = function(t2, i2) {
          this.data = p([t2, i2]), this.data.height = t2.height + 1, this.data.leaf = false, a(this.data, this.toBBox);
        }, r.prototype._chooseSplitIndex = function(t2, i2, n2) {
          for (var r2, e2, a2, o2, s2, l2, u8, m2 = 1 / 0, c2 = 1 / 0, p2 = i2; p2 <= n2 - i2; p2++) {
            var d2 = h(t2, 0, p2, this.toBBox), x = h(t2, p2, n2, this.toBBox), v3 = (e2 = d2, a2 = x, o2 = void 0, s2 = void 0, l2 = void 0, u8 = void 0, o2 = Math.max(e2.minX, a2.minX), s2 = Math.max(e2.minY, a2.minY), l2 = Math.min(e2.maxX, a2.maxX), u8 = Math.min(e2.maxY, a2.maxY), Math.max(0, l2 - o2) * Math.max(0, u8 - s2)), M = f(d2) + f(x);
            v3 < m2 ? (m2 = v3, r2 = p2, c2 = M < c2 ? M : c2) : v3 === m2 && M < c2 && (c2 = M, r2 = p2);
          }
          return r2 || n2 - i2;
        }, r.prototype._chooseSplitAxis = function(t2, i2, n2) {
          var r2 = t2.leaf ? this.compareMinX : s, e2 = t2.leaf ? this.compareMinY : l;
          this._allDistMargin(t2, i2, n2, r2) < this._allDistMargin(t2, i2, n2, e2) && t2.children.sort(r2);
        }, r.prototype._allDistMargin = function(t2, i2, n2, r2) {
          t2.children.sort(r2);
          for (var e2 = this.toBBox, a2 = h(t2, 0, i2, e2), s2 = h(t2, n2 - i2, n2, e2), l2 = u7(a2) + u7(s2), f2 = i2; f2 < n2 - i2; f2++) {
            var m2 = t2.children[f2];
            o(a2, t2.leaf ? e2(m2) : m2), l2 += u7(a2);
          }
          for (var c2 = n2 - i2 - 1; c2 >= i2; c2--) {
            var p2 = t2.children[c2];
            o(s2, t2.leaf ? e2(p2) : p2), l2 += u7(s2);
          }
          return l2;
        }, r.prototype._adjustParentBBoxes = function(t2, i2, n2) {
          for (var r2 = n2; r2 >= 0; r2--) o(i2[r2], t2);
        }, r.prototype._condense = function(t2) {
          for (var i2 = t2.length - 1, n2 = void 0; i2 >= 0; i2--) 0 === t2[i2].children.length ? i2 > 0 ? (n2 = t2[i2 - 1].children).splice(n2.indexOf(t2[i2]), 1) : this.clear() : a(t2[i2], this.toBBox);
        }, r;
      });
    }
  });

  // src/js/polyfills.ts
  Array.prototype.findIndex = Array.prototype.findIndex || function(callback) {
    if (this === null) {
      throw new TypeError(
        "Array.prototype.findIndex called on null or undefined"
      );
    } else if (typeof callback !== "function") {
      throw new TypeError("callback must be a function");
    }
    var list = Object(this);
    var length2 = list.length >>> 0;
    var thisArg = arguments[1];
    for (var i = 0; i < length2; i++) {
      if (callback.call(thisArg, list[i], i, list)) {
        return i;
      }
    }
    return -1;
  };
  Array.prototype.find = Array.prototype.find || function(callback) {
    if (this === null) {
      throw new TypeError("Array.prototype.find called on null or undefined");
    } else if (typeof callback !== "function") {
      throw new TypeError("callback must be a function");
    }
    var list = Object(this);
    var length2 = list.length >>> 0;
    var thisArg = arguments[1];
    for (var i = 0; i < length2; i++) {
      var element = list[i];
      if (callback.call(thisArg, element, i, list)) {
        return element;
      }
    }
  };
  if (typeof Object.assign != "function") {
    Object.assign = function(target) {
      "use strict";
      if (target == null) {
        throw new TypeError("Cannot convert undefined or null to object");
      }
      target = Object(target);
      for (var index = 1; index < arguments.length; index++) {
        var source = arguments[index];
        if (source != null) {
          for (var key in source) {
            if (Object.prototype.hasOwnProperty.call(source, key)) {
              target[key] = source[key];
            }
          }
        }
      }
      return target;
    };
  }
  (function(arr) {
    arr.forEach(function(item) {
      if (item.hasOwnProperty("remove")) {
        return;
      }
      Object.defineProperty(item, "remove", {
        configurable: true,
        enumerable: true,
        writable: true,
        value: function remove() {
          this.parentNode.removeChild(this);
        }
      });
    });
  })([Element.prototype, CharacterData.prototype, DocumentType.prototype]);
  if (!Array.prototype.includes) {
    Object.defineProperty(Array.prototype, "includes", {
      value: function(searchElement, fromIndex) {
        if (this == null) {
          throw new TypeError('"this" is null or not defined');
        }
        var o = Object(this);
        var len = o.length >>> 0;
        if (len === 0) {
          return false;
        }
        var n = fromIndex | 0;
        var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);
        function sameValueZero(x, y) {
          return x === y || typeof x === "number" && typeof y === "number" && isNaN(x) && isNaN(y);
        }
        while (k < len) {
          if (sameValueZero(o[k], searchElement)) {
            return true;
          }
          k++;
        }
        return false;
      }
    });
  }

  // package.json
  var package_default = {
    name: "@geoman-io/leaflet-geoman-free",
    version: "2.20.2",
    description: "A Leaflet Plugin For Editing Geometry Layers in Leaflet 1.0",
    keywords: [
      "leaflet",
      "geoman",
      "polygon management",
      "geometry editing",
      "map data",
      "map overlay",
      "polygon",
      "geojson",
      "leaflet-draw",
      "data-field-geojson",
      "ui-leaflet-draw"
    ],
    files: [
      "dist/leaflet-geoman.js",
      "dist/leaflet-geoman.min.js",
      "dist/leaflet-geoman.css",
      "dist/leaflet-geoman.d.ts",
      "dist/leaflet-geoman.js.map",
      "dist/leaflet-geoman.min.js.map",
      "dist/leaflet-geoman.css.map"
    ],
    main: "dist/leaflet-geoman.js",
    module: "dist/leaflet-geoman.js",
    types: "dist/leaflet-geoman.d.ts",
    exports: {
      ".": {
        types: "./dist/leaflet-geoman.d.ts",
        import: "./dist/leaflet-geoman.js",
        require: "./dist/leaflet-geoman.js",
        default: "./dist/leaflet-geoman.js"
      },
      "./dist/leaflet-geoman.css": "./dist/leaflet-geoman.css"
    },
    dependencies: {
      "@turf/boolean-contains": "^7.4.0",
      "@turf/kinks": "^7.4.0",
      "@turf/line-intersect": "^7.4.0",
      "@turf/line-split": "^7.4.0",
      lodash: "4.18.1",
      "polyclip-ts": "^0.16.8"
    },
    devDependencies: {
      "@types/geojson": "^7946.0.16",
      "@types/leaflet": "^1.9.22",
      "@types/lodash": "^4.17.25",
      "@types/node": "^20.19.43",
      "@vitest/coverage-v8": "^4.1.11",
      "cross-env": "^10.1.0",
      cypress: "^15.21.1",
      esbuild: "^0.28.2",
      husky: "^9.1.7",
      leaflet: "1.9.4",
      "lint-staged": "^17.4.1",
      oxfmt: "^0.66.0",
      oxlint: "^1.81.0",
      "prosthetic-hand": "2.2.2",
      tsx: "^4.23.13",
      typescript: "^6.0.3",
      vitest: "^4.1.11"
    },
    peerDependencies: {
      leaflet: "^1.2.0"
    },
    engines: {
      node: ">=20.0.0"
    },
    packageManager: "pnpm@10.34.5",
    scripts: {
      start: "pnpm run dev",
      dev: "cross-env DEV=true tsx bundle.mts",
      build: "tsx bundle.mts",
      test: "cypress run --browser chrome",
      "test:unit": "vitest run",
      "test:unit:watch": "vitest",
      "test:unit:coverage": "vitest run --coverage",
      "test:all": "pnpm run test:unit && pnpm run test",
      cypress: "cypress open",
      prepare: "pnpm run build && husky",
      lint: "oxlint src demo cypress test test-page.ts bundle.mts vitest.config.ts cypress.config.ts --fix && oxfmt --write src demo cypress test test-page.ts bundle.mts vitest.config.ts cypress.config.ts",
      "lint:check": "oxlint src demo cypress test test-page.ts bundle.mts vitest.config.ts cypress.config.ts && oxfmt --check src demo cypress test test-page.ts bundle.mts vitest.config.ts cypress.config.ts",
      typecheck: "tsc --noEmit && tsc --noEmit -p tsconfig.tools.json && tsc --noEmit -p cypress/tsconfig.json && tsc --noEmit -p demo/tsconfig.json && tsc --noEmit -p test/types/tsconfig.json"
    },
    repository: {
      type: "git",
      url: "git://github.com/geoman-io/leaflet-geoman.git"
    },
    author: {
      name: "Geoman.io",
      email: "sales@geoman.io",
      url: "http://geoman.io"
    },
    license: "MIT",
    bugs: {
      url: "https://github.com/geoman-io/leaflet-geoman/issues"
    },
    homepage: "https://geoman.io",
    "lint-staged": {
      "*.{js,ts,mjs,mts,cts}": "oxlint --fix",
      "*.{js,ts,mjs,mts,cts,css}": "oxfmt --write"
    }
  };

  // src/js/L.PM.Map.ts
  var import_merge2 = __toESM(require_merge());

  // src/assets/translations/en.json
  var en_default = {
    tooltips: {
      placeMarker: "Click to place marker",
      placeMarkerTouch: "Tap the map to place a marker",
      firstVertex: "Click to place first vertex",
      continueLine: "Click to continue drawing",
      finishLine: "Click any existing marker to finish",
      finishPoly: "Click first marker to finish",
      finishRect: "Click to finish",
      startCircle: "Click to place circle center",
      finishCircle: "Click to finish circle",
      placeCircleMarker: "Click to place circle marker",
      placeText: "Click to place text",
      selectFirstLayerFor: "Select first layer for {action}",
      selectSecondLayerFor: "Select second layer for {action}"
    },
    actions: {
      finish: "Finish",
      cancel: "Cancel",
      removeLastVertex: "Remove Last Vertex"
    },
    buttonTitles: {
      drawMarkerButton: "Draw Marker",
      drawPolyButton: "Draw Polygons",
      drawLineButton: "Draw Polyline",
      drawCircleButton: "Draw Circle",
      drawRectButton: "Draw Rectangle",
      editButton: "Edit Layers",
      dragButton: "Drag Layers",
      cutButton: "Cut Layers",
      deleteButton: "Remove Layers",
      drawCircleMarkerButton: "Draw Circle Marker",
      snappingButton: "Snap dragged marker to other layers and vertices",
      pinningButton: "Pin shared vertices together",
      rotateButton: "Rotate Layers",
      drawTextButton: "Draw Text",
      scaleButton: "Scale Layers",
      autoTracingButton: "Auto trace Line",
      snapGuidesButton: "Show SnapGuides",
      unionButton: "Union layers",
      differenceButton: "Subtract layers"
    },
    measurements: {
      totalLength: "Length",
      segmentLength: "Segment length",
      area: "Area",
      radius: "Radius",
      perimeter: "Perimeter",
      height: "Height",
      width: "Width",
      coordinates: "Position",
      coordinatesMarker: "Position Marker"
    }
  };

  // src/assets/translations/de.json
  var de_default = {
    tooltips: {
      placeMarker: "Platziere den Marker mit Klick",
      placeMarkerTouch: "Tippe auf die Karte, um einen Marker zu platzieren",
      firstVertex: "Platziere den ersten Marker mit Klick",
      continueLine: "Klicke, um weiter zu zeichnen",
      finishLine: "Beende mit Klick auf existierenden Marker",
      finishPoly: "Beende mit Klick auf ersten Marker",
      finishRect: "Beende mit Klick",
      startCircle: "Platziere das Kreiszentrum mit Klick",
      finishCircle: "Beende den Kreis mit Klick",
      placeCircleMarker: "Platziere den Kreismarker mit Klick",
      placeText: "Platziere den Text mit Klick"
    },
    actions: {
      finish: "Beenden",
      cancel: "Abbrechen",
      removeLastVertex: "Letzten Vertex l\xF6schen"
    },
    buttonTitles: {
      drawMarkerButton: "Marker zeichnen",
      drawPolyButton: "Polygon zeichnen",
      drawLineButton: "Polyline zeichnen",
      drawCircleButton: "Kreis zeichnen",
      drawRectButton: "Rechteck zeichnen",
      editButton: "Layer editieren",
      dragButton: "Layer bewegen",
      cutButton: "Layer schneiden",
      deleteButton: "Layer l\xF6schen",
      drawCircleMarkerButton: "Kreismarker zeichnen",
      snappingButton: "Bewegter Layer an andere Layer oder Vertexe einhacken",
      pinningButton: "Vertexe an der gleichen Position verkn\xFCpfen",
      rotateButton: "Layer drehen",
      drawTextButton: "Text zeichnen",
      scaleButton: "Layer skalieren",
      autoTracingButton: "Linie automatisch nachzeichen"
    },
    measurements: {
      totalLength: "L\xE4nge",
      segmentLength: "Segment L\xE4nge",
      area: "Fl\xE4che",
      radius: "Radius",
      perimeter: "Umfang",
      height: "H\xF6he",
      width: "Breite",
      coordinates: "Position",
      coordinatesMarker: "Position Marker"
    }
  };

  // src/assets/translations/it.json
  var it_default = {
    tooltips: {
      placeMarker: "Clicca per posizionare un Marker",
      placeMarkerTouch: "Tocca la mappa per posizionare un marker",
      firstVertex: "Clicca per posizionare il primo vertice",
      continueLine: "Clicca per continuare a disegnare",
      finishLine: "Clicca qualsiasi marker esistente per terminare",
      finishPoly: "Clicca il primo marker per terminare",
      finishRect: "Clicca per terminare",
      startCircle: "Clicca per posizionare il punto centrale del cerchio",
      finishCircle: "Clicca per terminare il cerchio",
      placeCircleMarker: "Clicca per posizionare un Marker del cherchio"
    },
    actions: {
      finish: "Termina",
      cancel: "Annulla",
      removeLastVertex: "Rimuovi l'ultimo vertice"
    },
    buttonTitles: {
      drawMarkerButton: "Disegna Marker",
      drawPolyButton: "Disegna Poligoni",
      drawLineButton: "Disegna Polilinea",
      drawCircleButton: "Disegna Cerchio",
      drawRectButton: "Disegna Rettangolo",
      editButton: "Modifica Livelli",
      dragButton: "Sposta Livelli",
      cutButton: "Ritaglia Livelli",
      deleteButton: "Elimina Livelli",
      drawCircleMarkerButton: "Disegna Marker del Cerchio",
      snappingButton: "Snap ha trascinato il pennarello su altri strati e vertici",
      pinningButton: "Pin condiviso vertici insieme",
      rotateButton: "Ruota livello"
    }
  };

  // src/assets/translations/id.json
  var id_default = {
    tooltips: {
      placeMarker: "Klik untuk menempatkan marker",
      placeMarkerTouch: "Ketuk peta untuk menempatkan marker",
      firstVertex: "Klik untuk menempatkan vertex pertama",
      continueLine: "Klik untuk meneruskan digitasi",
      finishLine: "Klik pada sembarang marker yang ada untuk mengakhiri",
      finishPoly: "Klik marker pertama untuk mengakhiri",
      finishRect: "Klik untuk mengakhiri",
      startCircle: "Klik untuk menempatkan titik pusat lingkaran",
      finishCircle: "Klik untuk mengakhiri lingkaran",
      placeCircleMarker: "Klik untuk menempatkan penanda lingkarann"
    },
    actions: {
      finish: "Selesai",
      cancel: "Batal",
      removeLastVertex: "Hilangkan Vertex Terakhir"
    },
    buttonTitles: {
      drawMarkerButton: "Digitasi Marker",
      drawPolyButton: "Digitasi Polygon",
      drawLineButton: "Digitasi Polyline",
      drawCircleButton: "Digitasi Lingkaran",
      drawRectButton: "Digitasi Segi Empat",
      editButton: "Edit Layer",
      dragButton: "Geser Layer",
      cutButton: "Potong Layer",
      deleteButton: "Hilangkan Layer",
      drawCircleMarkerButton: "Digitasi Penanda Lingkaran",
      snappingButton: "Jepretkan penanda yang ditarik ke lapisan dan simpul lain",
      pinningButton: "Sematkan simpul bersama bersama",
      rotateButton: "Putar lapisan"
    }
  };

  // src/assets/translations/ro.json
  var ro_default = {
    tooltips: {
      placeMarker: "Adaug\u0103 un punct",
      placeMarkerTouch: "Atinge\u021Bi harta pentru a plasa un punct",
      firstVertex: "Apas\u0103 aici pentru a ad\u0103uga primul Vertex",
      continueLine: "Apas\u0103 aici pentru a continua desenul",
      finishLine: "Apas\u0103 pe orice obiect pentru a finisa desenul",
      finishPoly: "Apas\u0103 pe primul obiect pentru a finisa",
      finishRect: "Apas\u0103 pentru a finisa",
      startCircle: "Apas\u0103 pentru a desena un cerc",
      finishCircle: "Apas\u0103 pentru a finisa un cerc",
      placeCircleMarker: "Adaug\u0103 un punct"
    },
    actions: {
      finish: "Termin\u0103",
      cancel: "Anuleaz\u0103",
      removeLastVertex: "\u0218terge ultimul Vertex"
    },
    buttonTitles: {
      drawMarkerButton: "Adaug\u0103 o bulin\u0103",
      drawPolyButton: "Deseneaz\u0103 un poligon",
      drawLineButton: "Deseneaz\u0103 o linie",
      drawCircleButton: "Deseneaz\u0103 un cerc",
      drawRectButton: "Deseneaz\u0103 un dreptunghi",
      editButton: "Editeaz\u0103 straturile",
      dragButton: "Mut\u0103 straturile",
      cutButton: "Taie straturile",
      deleteButton: "\u0218terge straturile",
      drawCircleMarkerButton: "Deseneaz\u0103 marcatorul cercului",
      snappingButton: "Fixa\u021Bi marcatorul glisat pe alte straturi \u0219i v\xE2rfuri",
      pinningButton: "Fixa\u021Bi v\xE2rfurile partajate \xEEmpreun\u0103",
      rotateButton: "Roti\u021Bi stratul"
    }
  };

  // src/assets/translations/ru.json
  var ru_default = {
    tooltips: {
      placeMarker: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043C\u0430\u0440\u043A\u0435\u0440",
      placeMarkerTouch: "\u041A\u043E\u0441\u043D\u0438\u0442\u0435\u0441\u044C \u043A\u0430\u0440\u0442\u044B, \u0447\u0442\u043E\u0431\u044B \u0440\u0430\u0437\u043C\u0435\u0441\u0442\u0438\u0442\u044C \u043C\u0430\u0440\u043A\u0435\u0440",
      firstVertex: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043F\u0435\u0440\u0432\u044B\u0439 \u043E\u0431\u044A\u0435\u043A\u0442",
      continueLine: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u043F\u0440\u043E\u0434\u043E\u043B\u0436\u0438\u0442\u044C \u0440\u0438\u0441\u043E\u0432\u0430\u043D\u0438\u0435",
      finishLine: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435 \u043B\u044E\u0431\u043E\u0439 \u0441\u0443\u0449\u0435\u0441\u0442\u0432\u0443\u044E\u0449\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440 \u0434\u043B\u044F \u0437\u0430\u0432\u0435\u0440\u0448\u0435\u043D\u0438\u044F",
      finishPoly: "\u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u043F\u0435\u0440\u0432\u0443\u044E \u0442\u043E\u0447\u043A\u0443, \u0447\u0442\u043E\u0431\u044B \u0437\u0430\u043A\u043E\u043D\u0447\u0438\u0442\u044C",
      finishRect: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u0437\u0430\u043A\u043E\u043D\u0447\u0438\u0442\u044C",
      startCircle: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u0434\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u0446\u0435\u043D\u0442\u0440 \u043A\u0440\u0443\u0433\u0430",
      finishCircle: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u0437\u0430\u0434\u0430\u0442\u044C \u0440\u0430\u0434\u0438\u0443\u0441",
      placeCircleMarker: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043A\u0440\u0443\u0433\u043E\u0432\u043E\u0439 \u043C\u0430\u0440\u043A\u0435\u0440"
    },
    actions: {
      finish: "\u0417\u0430\u0432\u0435\u0440\u0448\u0438\u0442\u044C",
      cancel: "\u041E\u0442\u043C\u0435\u043D\u0438\u0442\u044C",
      removeLastVertex: "\u041E\u0442\u043C\u0435\u043D\u0438\u0442\u044C \u043F\u043E\u0441\u043B\u0435\u0434\u043D\u0435\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0435"
    },
    buttonTitles: {
      drawMarkerButton: "\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u043C\u0430\u0440\u043A\u0435\u0440",
      drawPolyButton: "\u0420\u0438\u0441\u043E\u0432\u0430\u0442\u044C \u043F\u043E\u043B\u0438\u0433\u043E\u043D",
      drawLineButton: "\u0420\u0438\u0441\u043E\u0432\u0430\u0442\u044C \u043A\u0440\u0438\u0432\u0443\u044E",
      drawCircleButton: "\u0420\u0438\u0441\u043E\u0432\u0430\u0442\u044C \u043A\u0440\u0443\u0433",
      drawRectButton: "\u0420\u0438\u0441\u043E\u0432\u0430\u0442\u044C \u043F\u0440\u044F\u043C\u043E\u0443\u0433\u043E\u043B\u044C\u043D\u0438\u043A",
      editButton: "\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C \u0441\u043B\u043E\u0439",
      dragButton: "\u041F\u0435\u0440\u0435\u043D\u0435\u0441\u0442\u0438 \u0441\u043B\u043E\u0439",
      cutButton: "\u0412\u044B\u0440\u0435\u0437\u0430\u0442\u044C \u0441\u043B\u043E\u0439",
      deleteButton: "\u0423\u0434\u0430\u043B\u0438\u0442\u044C \u0441\u043B\u043E\u0439",
      drawCircleMarkerButton: "\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u043A\u0440\u0443\u0433\u043E\u0432\u043E\u0439 \u043C\u0430\u0440\u043A\u0435\u0440",
      snappingButton: "\u041F\u0440\u0438\u0432\u044F\u0437\u0430\u0442\u044C \u043F\u0435\u0440\u0435\u0442\u0430\u0441\u043A\u0438\u0432\u0430\u0435\u043C\u044B\u0439 \u043C\u0430\u0440\u043A\u0435\u0440 \u043A \u0434\u0440\u0443\u0433\u0438\u043C \u0441\u043B\u043E\u044F\u043C \u0438 \u0432\u0435\u0440\u0448\u0438\u043D\u0430\u043C",
      pinningButton: "\u0421\u0432\u044F\u0437\u0430\u0442\u044C \u043E\u0431\u0449\u0438\u0435 \u0442\u043E\u0447\u043A\u0438 \u0432\u043C\u0435\u0441\u0442\u0435",
      rotateButton: "\u041F\u043E\u0432\u043E\u0440\u043E\u0442 \u0441\u043B\u043E\u044F"
    }
  };

  // src/assets/translations/es.json
  var es_default = {
    tooltips: {
      placeMarker: "Presiona para colocar un marcador",
      placeMarkerTouch: "Toca el mapa para colocar un marcador",
      firstVertex: "Presiona para colocar el primer v\xE9rtice",
      continueLine: "Presiona para continuar dibujando",
      finishLine: "Presiona cualquier marcador existente para finalizar",
      finishPoly: "Presiona el primer marcador para finalizar",
      finishRect: "Presiona para finalizar",
      startCircle: "Presiona para colocar el centro del c\xEDrculo",
      finishCircle: "Presiona para finalizar el c\xEDrculo",
      placeCircleMarker: "Presiona para colocar un marcador de c\xEDrculo"
    },
    actions: {
      finish: "Finalizar",
      cancel: "Cancelar",
      removeLastVertex: "Eliminar \xFAltimo v\xE9rtice"
    },
    buttonTitles: {
      drawMarkerButton: "Dibujar Marcador",
      drawPolyButton: "Dibujar Pol\xEDgono",
      drawLineButton: "Dibujar L\xEDnea",
      drawCircleButton: "Dibujar C\xEDrculo",
      drawRectButton: "Dibujar Rect\xE1ngulo",
      editButton: "Editar Capas",
      dragButton: "Arrastrar Capas",
      cutButton: "Cortar Capas",
      deleteButton: "Eliminar Capas",
      drawCircleMarkerButton: "Dibujar Marcador de C\xEDrculo",
      snappingButton: "El marcador de Snap arrastrado a otras capas y v\xE9rtices",
      pinningButton: "Fijar juntos los v\xE9rtices compartidos",
      rotateButton: "Rotar capa"
    }
  };

  // src/assets/translations/nl.json
  var nl_default = {
    tooltips: {
      placeMarker: "Klik om een marker te plaatsen",
      placeMarkerTouch: "Tik op de kaart om een marker te plaatsen",
      firstVertex: "Klik om het eerste punt te plaatsen",
      continueLine: "Klik om te blijven tekenen",
      finishLine: "Klik op een bestaand punt om te be\xEBindigen",
      finishPoly: "Klik op het eerst punt om te be\xEBindigen",
      finishRect: "Klik om te be\xEBindigen",
      startCircle: "Klik om het middelpunt te plaatsen",
      finishCircle: "Klik om de cirkel te be\xEBindigen",
      placeCircleMarker: "Klik om een marker te plaatsen"
    },
    actions: {
      finish: "Bewaar",
      cancel: "Annuleer",
      removeLastVertex: "Verwijder laatste punt"
    },
    buttonTitles: {
      drawMarkerButton: "Plaats Marker",
      drawPolyButton: "Teken een vlak",
      drawLineButton: "Teken een lijn",
      drawCircleButton: "Teken een cirkel",
      drawRectButton: "Teken een vierkant",
      editButton: "Bewerk",
      dragButton: "Verplaats",
      cutButton: "Knip",
      deleteButton: "Verwijder",
      drawCircleMarkerButton: "Plaats Marker",
      snappingButton: "Snap gesleepte marker naar andere lagen en hoekpunten",
      pinningButton: "Speld gedeelde hoekpunten samen",
      rotateButton: "Laag roteren"
    }
  };

  // src/assets/translations/fr.json
  var fr_default = {
    tooltips: {
      placeMarker: "Cliquez pour placer un marqueur",
      placeMarkerTouch: "Appuyez sur la carte pour placer un marqueur",
      firstVertex: "Cliquez pour placer le premier sommet",
      continueLine: "Cliquez pour continuer \xE0 dessiner",
      finishLine: "Cliquez sur n'importe quel marqueur pour terminer",
      finishPoly: "Cliquez sur le premier marqueur pour terminer",
      finishRect: "Cliquez pour terminer",
      startCircle: "Cliquez pour placer le centre du cercle",
      finishCircle: "Cliquez pour finir le cercle",
      placeCircleMarker: "Cliquez pour placer le marqueur circulaire"
    },
    actions: {
      finish: "Terminer",
      cancel: "Annuler",
      removeLastVertex: "Retirer le dernier sommet"
    },
    buttonTitles: {
      drawMarkerButton: "Placer des marqueurs",
      drawPolyButton: "Dessiner des polygones",
      drawLineButton: "Dessiner des polylignes",
      drawCircleButton: "Dessiner un cercle",
      drawRectButton: "Dessiner un rectangle",
      editButton: "\xC9diter des calques",
      dragButton: "D\xE9placer des calques",
      cutButton: "Couper des calques",
      deleteButton: "Supprimer des calques",
      drawCircleMarkerButton: "Dessiner un marqueur circulaire",
      snappingButton: "Glisser le marqueur vers d'autres couches et sommets",
      pinningButton: "\xC9pingler ensemble les sommets partag\xE9s",
      rotateButton: "Tourner des calques"
    }
  };

  // src/assets/translations/zh.json
  var zh_default = {
    tooltips: {
      placeMarker: "\u5355\u51FB\u653E\u7F6E\u6807\u8BB0",
      placeMarkerTouch: "\u70B9\u51FB\u5730\u56FE\u653E\u7F6E\u6807\u8BB0",
      firstVertex: "\u5355\u51FB\u653E\u7F6E\u9996\u4E2A\u9876\u70B9",
      continueLine: "\u5355\u51FB\u7EE7\u7EED\u7ED8\u5236",
      finishLine: "\u5355\u51FB\u4EFB\u4F55\u5B58\u5728\u7684\u6807\u8BB0\u4EE5\u5B8C\u6210",
      finishPoly: "\u5355\u51FB\u7B2C\u4E00\u4E2A\u6807\u8BB0\u4EE5\u5B8C\u6210",
      finishRect: "\u5355\u51FB\u5B8C\u6210",
      startCircle: "\u5355\u51FB\u653E\u7F6E\u5706\u5FC3",
      finishCircle: "\u5355\u51FB\u5B8C\u6210\u5706\u5F62",
      placeCircleMarker: "\u70B9\u51FB\u653E\u7F6E\u5706\u5F62\u6807\u8BB0"
    },
    actions: {
      finish: "\u5B8C\u6210",
      cancel: "\u53D6\u6D88",
      removeLastVertex: "\u79FB\u9664\u6700\u540E\u7684\u9876\u70B9"
    },
    buttonTitles: {
      drawMarkerButton: "\u7ED8\u5236\u6807\u8BB0",
      drawPolyButton: "\u7ED8\u5236\u591A\u8FB9\u5F62",
      drawLineButton: "\u7ED8\u5236\u7EBF\u6BB5",
      drawCircleButton: "\u7ED8\u5236\u5706\u5F62",
      drawRectButton: "\u7ED8\u5236\u957F\u65B9\u5F62",
      editButton: "\u7F16\u8F91\u56FE\u5C42",
      dragButton: "\u62D6\u62FD\u56FE\u5C42",
      cutButton: "\u526A\u5207\u56FE\u5C42",
      deleteButton: "\u5220\u9664\u56FE\u5C42",
      drawCircleMarkerButton: "\u753B\u5706\u5708\u6807\u8BB0",
      snappingButton: "\u5C06\u62D6\u52A8\u7684\u6807\u8BB0\u6355\u6349\u5230\u5176\u4ED6\u56FE\u5C42\u548C\u9876\u70B9",
      pinningButton: "\u5C06\u5171\u4EAB\u9876\u70B9\u56FA\u5B9A\u5728\u4E00\u8D77",
      rotateButton: "\u65CB\u8F6C\u56FE\u5C42"
    }
  };

  // src/assets/translations/zh_tw.json
  var zh_tw_default = {
    tooltips: {
      placeMarker: "\u55AE\u64CA\u653E\u7F6E\u6A19\u8A18",
      placeMarkerTouch: "\u9EDE\u64CA\u5730\u5716\u653E\u7F6E\u6A19\u8A18",
      firstVertex: "\u55AE\u64CA\u653E\u7F6E\u7B2C\u4E00\u500B\u9802\u9EDE",
      continueLine: "\u55AE\u64CA\u7E7C\u7E8C\u7E6A\u88FD",
      finishLine: "\u55AE\u64CA\u4EFB\u4F55\u5B58\u5728\u7684\u6A19\u8A18\u4EE5\u5B8C\u6210",
      finishPoly: "\u55AE\u64CA\u7B2C\u4E00\u500B\u6A19\u8A18\u4EE5\u5B8C\u6210",
      finishRect: "\u55AE\u64CA\u5B8C\u6210",
      startCircle: "\u55AE\u64CA\u653E\u7F6E\u5713\u5FC3",
      finishCircle: "\u55AE\u64CA\u5B8C\u6210\u5713\u5F62",
      placeCircleMarker: "\u9EDE\u64CA\u653E\u7F6E\u5713\u5F62\u6A19\u8A18"
    },
    actions: {
      finish: "\u5B8C\u6210",
      cancel: "\u53D6\u6D88",
      removeLastVertex: "\u79FB\u9664\u6700\u5F8C\u4E00\u500B\u9802\u9EDE"
    },
    buttonTitles: {
      drawMarkerButton: "\u653E\u7F6E\u6A19\u8A18",
      drawPolyButton: "\u7E6A\u88FD\u591A\u908A\u5F62",
      drawLineButton: "\u7E6A\u88FD\u7DDA\u6BB5",
      drawCircleButton: "\u7E6A\u88FD\u5713\u5F62",
      drawRectButton: "\u7E6A\u88FD\u65B9\u5F62",
      editButton: "\u7DE8\u8F2F\u5716\u5F62",
      dragButton: "\u79FB\u52D5\u5716\u5F62",
      cutButton: "\u88C1\u5207\u5716\u5F62",
      deleteButton: "\u522A\u9664\u5716\u5F62",
      drawCircleMarkerButton: "\u756B\u5713\u5708\u6A19\u8A18",
      snappingButton: "\u5C07\u62D6\u52D5\u7684\u6A19\u8A18\u5C0D\u9F4A\u5230\u5176\u4ED6\u5716\u5C64\u548C\u9802\u9EDE",
      pinningButton: "\u5C07\u5171\u4EAB\u9802\u9EDE\u56FA\u5B9A\u5728\u4E00\u8D77",
      rotateButton: "\u65CB\u8F49\u5716\u5F62"
    }
  };

  // src/assets/translations/pt_br.json
  var pt_br_default = {
    tooltips: {
      placeMarker: "Clique para posicionar o marcador",
      placeMarkerTouch: "Toque no mapa para posicionar um marcador",
      firstVertex: "Clique para posicionar o primeiro v\xE9rtice",
      continueLine: "Clique para continuar desenhando",
      finishLine: "Clique em qualquer marcador existente para finalizar",
      finishPoly: "Clique no primeiro marcador para finalizar",
      finishRect: "Clique para finalizar",
      startCircle: "Clique para posicionar o centro do c\xEDrculo",
      finishCircle: "Clique para finalizar o c\xEDrculo",
      placeCircleMarker: "Clique para posicionar o marcador circular",
      placeText: "Clique para inserir texto"
    },
    actions: {
      finish: "Finalizar",
      cancel: "Cancelar",
      removeLastVertex: "Remover \xFAltimo v\xE9rtice"
    },
    buttonTitles: {
      drawMarkerButton: "Desenhar Marcador",
      drawPolyButton: "Desenhar Pol\xEDgonos",
      drawLineButton: "Desenhar Linha Poligonal",
      drawCircleButton: "Desenhar C\xEDrculo",
      drawRectButton: "Desenhar Ret\xE2ngulo",
      editButton: "Editar Camadas",
      dragButton: "Arrastar Camadas",
      cutButton: "Recortar Camadas",
      deleteButton: "Remover Camadas",
      drawCircleMarkerButton: "Desenhar Marcador de C\xEDrculo",
      snappingButton: "Ajustar marcador arrastado a outras camadas e v\xE9rtices",
      pinningButton: "Unir v\xE9rtices compartilhados",
      rotateButton: "Rotacionar Camadas",
      drawTextButton: "Desenhar Texto",
      scaleButton: "Redimensionar Camadas",
      autoTracingButton: "Tra\xE7ado Autom\xE1tico de Linha"
    },
    measurements: {
      totalLength: "Comprimento",
      segmentLength: "Comprimento do Segmento",
      area: "\xC1rea",
      radius: "Raio",
      perimeter: "Per\xEDmetro",
      height: "Altura",
      width: "Largura",
      coordinates: "Posi\xE7\xE3o",
      coordinatesMarker: "Marcador de Posi\xE7\xE3o"
    }
  };

  // src/assets/translations/pt_pt.json
  var pt_pt_default = {
    tooltips: {
      placeMarker: "Clique para colocar marcador",
      placeMarkerTouch: "Toque no mapa para colocar um marcador",
      firstVertex: "Clique para colocar primeiro v\xE9rtice",
      continueLine: "Clique para continuar a desenhar",
      finishLine: "Clique num marcador existente para terminar",
      finishPoly: "Clique no primeiro marcador para terminar",
      finishRect: "Clique para terminar",
      startCircle: "Clique para colocar o centro do c\xEDrculo",
      finishCircle: "Clique para terminar o c\xEDrculo",
      placeCircleMarker: "Clique para colocar marcador de c\xEDrculo",
      placeText: "Clique para colocar texto"
    },
    actions: {
      finish: "Terminar",
      cancel: "Cancelar",
      removeLastVertex: "Remover \xDAltimo V\xE9rtice"
    },
    buttonTitles: {
      drawMarkerButton: "Desenhar Marcador",
      drawPolyButton: "Desenhar Pol\xEDgonos",
      drawLineButton: "Desenhar Polilinha",
      drawCircleButton: "Desenhar C\xEDrculo",
      drawRectButton: "Desenhar Ret\xE2ngulo",
      editButton: "Editar Camadas",
      dragButton: "Arrastar Camadas",
      cutButton: "Cortar Camadas",
      deleteButton: "Remover Camadas",
      drawCircleMarkerButton: "Desenhar Marcador de C\xEDrculo",
      snappingButton: "Ajustar marcador arrastado a outras camadas e v\xE9rtices",
      pinningButton: "Unir v\xE9rtices partilhados",
      rotateButton: "Rodar Camadas",
      drawTextButton: "Desenhar Texto",
      scaleButton: "Escalar Camadas",
      autoTracingButton: "Tra\xE7ado Autom\xE1tico de Linha"
    },
    measurements: {
      totalLength: "Comprimento",
      segmentLength: "Comprimento do Segmento",
      area: "\xC1rea",
      radius: "Raio",
      perimeter: "Per\xEDmetro",
      height: "Altura",
      width: "Largura",
      coordinates: "Posi\xE7\xE3o",
      coordinatesMarker: "Marcador de Posi\xE7\xE3o"
    }
  };

  // src/assets/translations/pl.json
  var pl_default = {
    tooltips: {
      placeMarker: "Kliknij, aby umie\u015Bci\u0107 znacznik",
      placeMarkerTouch: "Dotknij map\u0119, aby umie\u015Bci\u0107 znacznik",
      firstVertex: "Kliknij, aby umie\u015Bci\u0107 pierwszy wierzcho\u0142ek",
      continueLine: "Kliknij, aby kontynuowa\u0107 rysowanie",
      finishLine: "Kliknij dowolny istniej\u0105cy znacznik, aby zako\u0144czy\u0107",
      finishPoly: "Kliknij pierwszy znacznik, aby zako\u0144czy\u0107",
      finishRect: "Kliknij, aby zako\u0144czy\u0107",
      startCircle: "Kliknij, aby umie\u015Bci\u0107 \u015Brodek okr\u0119gu",
      finishCircle: "Kliknij, aby zako\u0144czy\u0107 okr\u0105g",
      placeCircleMarker: "Kliknij, aby umie\u015Bci\u0107 znacznik okr\u0119gu",
      placeText: "Kliknij, aby umie\u015Bci\u0107 tekst"
    },
    actions: {
      finish: "Zako\u0144cz",
      cancel: "Anuluj",
      removeLastVertex: "Usu\u0144 ostatni wierzcho\u0142ek"
    },
    buttonTitles: {
      drawMarkerButton: "Rysuj znacznik",
      drawPolyButton: "Rysuj wielok\u0105t",
      drawLineButton: "Rysuj lini\u0119",
      drawCircleButton: "Rysuj okr\u0105g",
      drawRectButton: "Rysuj prostok\u0105t",
      editButton: "Edytuj warstwy",
      dragButton: "Przeci\u0105gnij warstwy",
      cutButton: "Wytnij warstwy",
      deleteButton: "Usu\u0144 warstwy",
      drawCircleMarkerButton: "Rysuj znacznik okr\u0105g\u0142y",
      snappingButton: "Przyci\u0105gnij przenoszony znacznik do innych warstw i wierzcho\u0142k\xF3w",
      pinningButton: "Przypnij wsp\xF3lne wierzcho\u0142ki razem",
      rotateButton: "Obr\xF3\u0107 warstwy",
      drawTextButton: "Rysuj tekst",
      scaleButton: "Skaluj warstwy",
      autoTracingButton: "Automatyczne \u015Bledzenie linii"
    },
    measurements: {
      totalLength: "D\u0142ugo\u015B\u0107",
      segmentLength: "D\u0142ugo\u015B\u0107 odcinka",
      area: "Obszar",
      radius: "Promie\u0144",
      perimeter: "Obw\xF3d",
      height: "Wysoko\u015B\u0107",
      width: "Szeroko\u015B\u0107",
      coordinates: "Pozycja",
      coordinatesMarker: "Znacznik pozycji"
    }
  };

  // src/assets/translations/sv.json
  var sv_default = {
    tooltips: {
      placeMarker: "Klicka f\xF6r att placera mark\xF6r",
      placeMarkerTouch: "Tryck p\xE5 kartan f\xF6r att placera en mark\xF6r",
      firstVertex: "Klicka f\xF6r att placera f\xF6rsta h\xF6rnet",
      continueLine: "Klicka f\xF6r att forts\xE4tta rita",
      finishLine: "Klicka p\xE5 en existerande punkt f\xF6r att slutf\xF6ra",
      finishPoly: "Klicka p\xE5 den f\xF6rsta punkten f\xF6r att slutf\xF6ra",
      finishRect: "Klicka f\xF6r att slutf\xF6ra",
      startCircle: "Klicka f\xF6r att placera cirkelns centrum",
      finishCircle: "Klicka f\xF6r att slutf\xF6ra cirkeln",
      placeCircleMarker: "Klicka f\xF6r att placera cirkelmark\xF6r"
    },
    actions: {
      finish: "Slutf\xF6r",
      cancel: "Avbryt",
      removeLastVertex: "Ta bort sista h\xF6rnet"
    },
    buttonTitles: {
      drawMarkerButton: "Rita Mark\xF6r",
      drawPolyButton: "Rita Polygoner",
      drawLineButton: "Rita Linje",
      drawCircleButton: "Rita Cirkel",
      drawRectButton: "Rita Rektangel",
      editButton: "Redigera Lager",
      dragButton: "Dra Lager",
      cutButton: "Klipp i Lager",
      deleteButton: "Ta bort Lager",
      drawCircleMarkerButton: "Rita Cirkelmark\xF6r",
      snappingButton: "Sn\xE4pp dra mark\xF6ren till andra lager och h\xF6rn",
      pinningButton: "F\xE4st delade h\xF6rn tillsammans",
      rotateButton: "Rotera lagret"
    }
  };

  // src/assets/translations/el.json
  var el_default = {
    tooltips: {
      placeMarker: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03BF\u03C0\u03BF\u03B8\u03B5\u03C4\u03AE\u03C3\u03B5\u03C4\u03B5 \u0394\u03B5\u03AF\u03BA\u03C4\u03B7",
      placeMarkerTouch: "\u03A0\u03B1\u03C4\u03AE\u03C3\u03C4\u03B5 \u03C3\u03C4\u03BF \u03C7\u03AC\u03C1\u03C4\u03B7 \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03BF\u03C0\u03BF\u03B8\u03B5\u03C4\u03AE\u03C3\u03B5\u03C4\u03B5 \u03B4\u03B5\u03AF\u03BA\u03C4\u03B7",
      firstVertex: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03BF\u03C0\u03BF\u03B8\u03B5\u03C4\u03AE\u03C3\u03B5\u03C4\u03B5 \u03C4\u03BF \u03C0\u03C1\u03CE\u03C4\u03BF \u03C3\u03B7\u03BC\u03B5\u03AF\u03BF",
      continueLine: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C3\u03C5\u03BD\u03B5\u03C7\u03AF\u03C3\u03B5\u03C4\u03B5 \u03BD\u03B1 \u03C3\u03C7\u03B5\u03B4\u03B9\u03AC\u03B6\u03B5\u03C4\u03B5",
      finishLine: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03C3\u03B5 \u03BF\u03C0\u03BF\u03B9\u03BF\u03BD\u03B4\u03AE\u03C0\u03BF\u03C4\u03B5 \u03C5\u03C0\u03AC\u03C1\u03C7\u03BF\u03BD \u03C3\u03B7\u03BC\u03B5\u03AF\u03BF \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03BF\u03BB\u03BF\u03BA\u03BB\u03B7\u03C1\u03C9\u03B8\u03B5\u03AF",
      finishPoly: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03C3\u03C4\u03BF \u03C0\u03C1\u03CE\u03C4\u03BF \u03C3\u03B7\u03BC\u03B5\u03AF\u03BF \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03B5\u03BB\u03B5\u03B9\u03CE\u03C3\u03B5\u03C4\u03B5",
      finishRect: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03B5\u03BB\u03B5\u03B9\u03CE\u03C3\u03B5\u03C4\u03B5",
      startCircle: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03BF\u03C0\u03BF\u03B8\u03B5\u03C4\u03AE\u03C3\u03B5\u03C4\u03B5 \u03BA\u03AD\u03BD\u03C4\u03C1\u03BF \u039A\u03CD\u03BA\u03BB\u03BF\u03C5",
      finishCircle: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03BF\u03BB\u03BF\u03BA\u03BB\u03B7\u03C1\u03CE\u03C3\u03B5\u03C4\u03B5 \u03C4\u03BF\u03BD \u039A\u03CD\u03BA\u03BB\u03BF",
      placeCircleMarker: "\u039A\u03AC\u03BD\u03C4\u03B5 \u03BA\u03BB\u03B9\u03BA \u03B3\u03B9\u03B1 \u03BD\u03B1 \u03C4\u03BF\u03C0\u03BF\u03B8\u03B5\u03C4\u03AE\u03C3\u03B5\u03C4\u03B5 \u039A\u03C5\u03BA\u03BB\u03B9\u03BA\u03CC \u0394\u03B5\u03AF\u03BA\u03C4\u03B7"
    },
    actions: {
      finish: "\u03A4\u03AD\u03BB\u03BF\u03C2",
      cancel: "\u0391\u03BA\u03CD\u03C1\u03C9\u03C3\u03B7",
      removeLastVertex: "\u039A\u03B1\u03C4\u03AC\u03C1\u03B3\u03B7\u03C3\u03B7 \u03C4\u03B5\u03BB\u03B5\u03C5\u03C4\u03B1\u03AF\u03BF\u03C5 \u03C3\u03B7\u03BC\u03B5\u03AF\u03BF\u03C5"
    },
    buttonTitles: {
      drawMarkerButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u0394\u03B5\u03AF\u03BA\u03C4\u03B7",
      drawPolyButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u03A0\u03BF\u03BB\u03C5\u03B3\u03CE\u03BD\u03BF\u03C5",
      drawLineButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u0393\u03C1\u03B1\u03BC\u03BC\u03AE\u03C2",
      drawCircleButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u039A\u03CD\u03BA\u03BB\u03BF\u03C5",
      drawRectButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u039F\u03C1\u03B8\u03BF\u03B3\u03C9\u03BD\u03AF\u03BF\u03C5",
      editButton: "\u0395\u03C0\u03B5\u03BE\u03B5\u03C1\u03B3\u03B1\u03C3\u03AF\u03B1 \u0395\u03C0\u03B9\u03C0\u03AD\u03B4\u03C9\u03BD",
      dragButton: "\u039C\u03B5\u03C4\u03B1\u03C6\u03BF\u03C1\u03AC \u0395\u03C0\u03B9\u03C0\u03AD\u03B4\u03C9\u03BD",
      cutButton: "\u0391\u03C0\u03BF\u03BA\u03BF\u03C0\u03AE \u0395\u03C0\u03B9\u03C0\u03AD\u03B4\u03C9\u03BD",
      deleteButton: "\u039A\u03B1\u03C4\u03AC\u03C1\u03B3\u03B7\u03C3\u03B7 \u0395\u03C0\u03B9\u03C0\u03AD\u03B4\u03C9\u03BD",
      drawCircleMarkerButton: "\u03A3\u03C7\u03B5\u03B4\u03AF\u03B1\u03C3\u03B7 \u039A\u03C5\u03BA\u03BB\u03B9\u03BA\u03BF\u03CD \u0394\u03B5\u03AF\u03BA\u03C4\u03B7",
      snappingButton: "\u03A0\u03C1\u03BF\u03C3\u03BA\u03CC\u03BB\u03BB\u03B7\u03C3\u03B7 \u03C4\u03BF\u03C5 \u0394\u03B5\u03AF\u03BA\u03C4\u03B7 \u03BC\u03B5\u03C4\u03B1\u03C6\u03BF\u03C1\u03AC\u03C2 \u03C3\u03B5 \u03AC\u03BB\u03BB\u03B1 \u0395\u03C0\u03AF\u03C0\u03B5\u03B4\u03B1 \u03BA\u03B1\u03B9 \u039A\u03BF\u03C1\u03C5\u03C6\u03AD\u03C2",
      pinningButton: "\u03A0\u03B5\u03C1\u03B9\u03BA\u03BF\u03C0\u03AE \u03BA\u03BF\u03B9\u03BD\u03CE\u03BD \u03BA\u03BF\u03C1\u03C5\u03C6\u03CE\u03BD \u03BC\u03B1\u03B6\u03AF",
      rotateButton: "\u03A0\u03B5\u03C1\u03B9\u03C3\u03C4\u03C1\u03AD\u03C8\u03C4\u03B5 \u03C4\u03BF \u03C3\u03C4\u03C1\u03CE\u03BC\u03B1"
    }
  };

  // src/assets/translations/hu.json
  var hu_default = {
    tooltips: {
      placeMarker: "Kattintson a jel\xF6l\u0151 elhelyez\xE9s\xE9hez",
      placeMarkerTouch: "\xC9rintse meg a t\xE9rk\xE9pet a jel\xF6l\u0151 elhelyez\xE9s\xE9hez",
      firstVertex: "Kattintson az els\u0151 pont elhelyez\xE9s\xE9hez",
      continueLine: "Kattintson a k\xF6vetkez\u0151 pont elhelyez\xE9s\xE9hez",
      finishLine: "A befejez\xE9shez kattintson egy megl\xE9v\u0151 pontra",
      finishPoly: "A befejez\xE9shez kattintson az els\u0151 pontra",
      finishRect: "Kattintson a befejez\xE9shez",
      startCircle: "Kattintson a k\xF6r k\xF6z\xE9ppontj\xE1nak elhelyez\xE9s\xE9hez",
      finishCircle: "Kattintson a k\xF6r befejez\xE9s\xE9hez",
      placeCircleMarker: "Kattintson a k\xF6rjel\xF6l\u0151 elhelyez\xE9s\xE9hez"
    },
    actions: {
      finish: "Befejez\xE9s",
      cancel: "M\xE9gse",
      removeLastVertex: "Utols\xF3 pont elt\xE1vol\xEDt\xE1sa"
    },
    buttonTitles: {
      drawMarkerButton: "Jel\xF6l\u0151 rajzol\xE1sa",
      drawPolyButton: "Poligon rajzol\xE1sa",
      drawLineButton: "Vonal rajzol\xE1sa",
      drawCircleButton: "K\xF6r rajzol\xE1sa",
      drawRectButton: "N\xE9gyzet rajzol\xE1sa",
      editButton: "Elemek szerkeszt\xE9se",
      dragButton: "Elemek mozgat\xE1sa",
      cutButton: "Elemek v\xE1g\xE1sa",
      deleteButton: "Elemek t\xF6rl\xE9se",
      drawCircleMarkerButton: "K\xF6r jel\xF6l\u0151 rajzol\xE1sa",
      snappingButton: "Kapcsolja a jel\xF6lt\u0151t m\xE1sik elemhez vagy ponthoz",
      pinningButton: "K\xF6z\xF6s pontok \xF6sszek\xF6t\xE9se",
      rotateButton: "F\xF3lia elforgat\xE1sa"
    }
  };

  // src/assets/translations/da.json
  var da_default = {
    tooltips: {
      placeMarker: "Tryk for at placere en mark\xF8r",
      placeMarkerTouch: "Tryk p\xE5 kortet for at placere en mark\xF8r",
      firstVertex: "Tryk for at placere det f\xF8rste punkt",
      continueLine: "Tryk for at forts\xE6tte linjen",
      finishLine: "Tryk p\xE5 et eksisterende punkt for at afslutte",
      finishPoly: "Tryk p\xE5 det f\xF8rste punkt for at afslutte",
      finishRect: "Tryk for at afslutte",
      startCircle: "Tryk for at placere cirklens center",
      finishCircle: "Tryk for at afslutte cirklen",
      placeCircleMarker: "Tryk for at placere en cirkelmark\xF8r"
    },
    actions: {
      finish: "Afslut",
      cancel: "Afbryd",
      removeLastVertex: "Fjern sidste punkt"
    },
    buttonTitles: {
      drawMarkerButton: "Placer mark\xF8r",
      drawPolyButton: "Tegn polygon",
      drawLineButton: "Tegn linje",
      drawCircleButton: "Tegn cirkel",
      drawRectButton: "Tegn firkant",
      editButton: "Rediger",
      dragButton: "Tr\xE6k",
      cutButton: "Klip",
      deleteButton: "Fjern",
      drawCircleMarkerButton: "Tegn cirkelmark\xF8r",
      snappingButton: "Fastg\xF8r trukket mark\xF8r til andre elementer",
      pinningButton: "Sammenl\xE6g delte elementer",
      rotateButton: "Roter laget"
    }
  };

  // src/assets/translations/no.json
  var no_default = {
    tooltips: {
      placeMarker: "Klikk for \xE5 plassere punkt",
      placeMarkerTouch: "Trykk p\xE5 kartet for \xE5 plassere et punkt",
      firstVertex: "Klikk for \xE5 plassere f\xF8rste punkt",
      continueLine: "Klikk for \xE5 tegne videre",
      finishLine: "Klikk p\xE5 et eksisterende punkt for \xE5 fullf\xF8re",
      finishPoly: "Klikk f\xF8rste punkt for \xE5 fullf\xF8re",
      finishRect: "Klikk for \xE5 fullf\xF8re",
      startCircle: "Klikk for \xE5 sette sirkel midtpunkt",
      finishCircle: "Klikk for \xE5 fullf\xF8re sirkel",
      placeCircleMarker: "Klikk for \xE5 plassere sirkel",
      placeText: "Klikk for \xE5 plassere tekst"
    },
    actions: {
      finish: "Fullf\xF8r",
      cancel: "Kanseller",
      removeLastVertex: "Fjern forrige punkt"
    },
    buttonTitles: {
      drawMarkerButton: "Tegn punkt",
      drawPolyButton: "Tegn flate",
      drawLineButton: "Tegn linje",
      drawCircleButton: "Tegn sirkel",
      drawRectButton: "Tegn rektangel",
      editButton: "Rediger objekter",
      dragButton: "Dra objekter",
      cutButton: "Kutt objekter",
      deleteButton: "Fjern objekter",
      drawCircleMarkerButton: "Tegn sirkel-punkt",
      snappingButton: "Fest dratt punkt til andre objekter og punkt",
      pinningButton: "Pin delte punkter sammen",
      rotateButton: "Rot\xE9r objekter",
      drawTextButton: "Tegn tekst",
      scaleButton: "Skal\xE9r objekter",
      autoTracingButton: "Automatisk sporing av linje"
    },
    measurements: {
      totalLength: "Lengde",
      segmentLength: "Segmentlengde",
      area: "Omr\xE5de",
      radius: "Radius",
      perimeter: "Omriss",
      height: "H\xF8yde",
      width: "Bredde",
      coordinates: "Posisjon",
      coordinatesMarker: "Posisjonsmark\xF8r"
    }
  };

  // src/assets/translations/fa.json
  var fa_default = {
    tooltips: {
      placeMarker: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u062C\u0627\u0646\u0645\u0627\u06CC\u06CC \u0646\u0634\u0627\u0646",
      placeMarkerTouch: "\u0631\u0648\u06CC \u0646\u0642\u0634\u0647 \u0636\u0631\u0628\u0647 \u0628\u0632\u0646\u06CC\u062F \u062A\u0627 \u0646\u0634\u0627\u0646 \u0628\u06AF\u0630\u0627\u0631\u06CC\u062F",
      firstVertex: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u0631\u0633\u0645 \u0627\u0648\u0644\u06CC\u0646 \u0631\u0623\u0633",
      continueLine: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u0627\u062F\u0627\u0645\u0647 \u0631\u0633\u0645",
      finishLine: "\u06A9\u0644\u06CC\u06A9 \u0631\u0648\u06CC \u0647\u0631 \u0646\u0634\u0627\u0646 \u0645\u0648\u062C\u0648\u062F \u0628\u0631\u0627\u06CC \u067E\u0627\u06CC\u0627\u0646",
      finishPoly: "\u06A9\u0644\u06CC\u06A9 \u0631\u0648\u06CC \u0627\u0648\u0644\u06CC\u0646 \u0646\u0634\u0627\u0646 \u0628\u0631\u0627\u06CC \u067E\u0627\u06CC\u0627\u0646",
      finishRect: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u067E\u0627\u06CC\u0627\u0646",
      startCircle: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u0631\u0633\u0645 \u0645\u0631\u06A9\u0632 \u062F\u0627\u06CC\u0631\u0647",
      finishCircle: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u067E\u0627\u06CC\u0627\u0646 \u0631\u0633\u0645 \u062F\u0627\u06CC\u0631\u0647",
      placeCircleMarker: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u0631\u0633\u0645 \u0646\u0634\u0627\u0646 \u062F\u0627\u06CC\u0631\u0647",
      placeText: "\u06A9\u0644\u06CC\u06A9 \u0628\u0631\u0627\u06CC \u0646\u0648\u0634\u062A\u0646 \u0645\u062A\u0646"
    },
    actions: {
      finish: "\u067E\u0627\u06CC\u0627\u0646",
      cancel: "\u0644\u0641\u0648",
      removeLastVertex: "\u062D\u0630\u0641 \u0622\u062E\u0631\u06CC\u0646 \u0631\u0623\u0633"
    },
    buttonTitles: {
      drawMarkerButton: "\u062F\u0631\u062C \u0646\u0634\u0627\u0646",
      drawPolyButton: "\u0631\u0633\u0645 \u0686\u0646\u062F\u0636\u0644\u0639\u06CC",
      drawLineButton: "\u0631\u0633\u0645 \u062E\u0637",
      drawCircleButton: "\u0631\u0633\u0645 \u062F\u0627\u06CC\u0631\u0647",
      drawRectButton: "\u0631\u0633\u0645 \u0686\u0647\u0627\u0631\u0636\u0644\u0639\u06CC",
      editButton: "\u0648\u06CC\u0631\u0627\u06CC\u0634 \u0644\u0627\u06CC\u0647\u200C\u0647\u0627",
      dragButton: "\u062C\u0627\u0628\u062C\u0627\u06CC\u06CC \u0644\u0627\u06CC\u0647\u200C\u0647\u0627",
      cutButton: "\u0628\u0631\u0634 \u0644\u0627\u06CC\u0647\u200C\u0647\u0627",
      deleteButton: "\u062D\u0630\u0641 \u0644\u0627\u06CC\u0647\u200C\u0647\u0627",
      drawCircleMarkerButton: "\u0631\u0633\u0645 \u0646\u0634\u0627\u0646 \u062F\u0627\u06CC\u0631\u0647",
      snappingButton: "\u0646\u0634\u0627\u0646\u06AF\u0631 \u0631\u0627 \u0628\u0647 \u0644\u0627\u06CC\u0647\u200C\u0647\u0627 \u0648 \u0631\u0626\u0648\u0633 \u062F\u06CC\u06AF\u0631 \u0628\u06A9\u0634\u06CC\u062F",
      pinningButton: "\u0631\u0626\u0648\u0633 \u0645\u0634\u062A\u0631\u06A9 \u0631\u0627 \u0628\u0627 \u0647\u0645 \u067E\u06CC\u0646 \u06A9\u0646\u06CC\u062F",
      rotateButton: "\u0686\u0631\u062E\u0634 \u0644\u0627\u06CC\u0647",
      drawTextButton: "\u0631\u0633\u0645 \u0645\u062A\u0646",
      scaleButton: "\u0645\u0642\u06CC\u0627\u0633\u200C\u06AF\u0630\u0627\u0631\u06CC",
      autoTracingButton: "\u0631\u062F\u06CC\u0627\u0628 \u062E\u0648\u062F\u06A9\u0627\u0631"
    },
    measurements: {
      totalLength: "\u0637\u0648\u0644",
      segmentLength: "\u0637\u0648\u0644 \u0628\u062E\u0634",
      area: "\u0646\u0627\u062D\u06CC\u0647",
      radius: "\u0634\u0639\u0627\u0639",
      perimeter: "\u0645\u062D\u06CC\u0637",
      height: "\u0627\u0631\u062A\u0641\u0627\u0639",
      width: "\u0639\u0631\u0636",
      coordinates: "\u0645\u0648\u0642\u0639\u06CC\u062A",
      coordinatesMarker: "\u0645\u0648\u0642\u0639\u06CC\u062A \u0646\u0634\u0627\u0646"
    }
  };

  // src/assets/translations/ua.json
  var ua_default = {
    tooltips: {
      placeMarker: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043C\u0430\u0440\u043A\u0435\u0440",
      placeMarkerTouch: "\u0422\u043E\u0440\u043A\u043D\u0456\u0442\u044C\u0441\u044F \u043A\u0430\u0440\u0442\u0438, \u0449\u043E\u0431 \u0440\u043E\u0437\u043C\u0456\u0441\u0442\u0438\u0442\u0438 \u043C\u0430\u0440\u043A\u0435\u0440",
      firstVertex: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043F\u0435\u0440\u0448\u0443 \u0432\u0435\u0440\u0448\u0438\u043D\u0443",
      continueLine: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u043F\u0440\u043E\u0434\u043E\u0432\u0436\u0438\u0442\u0438 \u043C\u0430\u043B\u044E\u0432\u0430\u0442\u0438",
      finishLine: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C \u0431\u0443\u0434\u044C-\u044F\u043A\u0438\u0439 \u0456\u0441\u043D\u0443\u044E\u0447\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440 \u0434\u043B\u044F \u0437\u0430\u0432\u0435\u0440\u0448\u0435\u043D\u043D\u044F",
      finishPoly: "\u0412\u0438\u0431\u0435\u0440\u0456\u0442\u044C \u043F\u0435\u0440\u0448\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440, \u0449\u043E\u0431 \u0437\u0430\u0432\u0435\u0440\u0448\u0438\u0442\u0438",
      finishRect: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u0437\u0430\u0432\u0435\u0440\u0448\u0438\u0442\u0438",
      startCircle: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u0434\u043E\u0434\u0430\u0442\u0438 \u0446\u0435\u043D\u0442\u0440 \u043A\u043E\u043B\u0430",
      finishCircle: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u0437\u0430\u0432\u0435\u0440\u0448\u0438\u0442\u0438 \u043A\u043E\u043B\u043E",
      placeCircleMarker: "\u041D\u0430\u0442\u0438\u0441\u043D\u0456\u0442\u044C, \u0449\u043E\u0431 \u043D\u0430\u043D\u0435\u0441\u0442\u0438 \u043A\u0440\u0443\u0433\u043E\u0432\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440"
    },
    actions: {
      finish: "\u0417\u0430\u0432\u0435\u0440\u0448\u0438\u0442\u0438",
      cancel: "\u0412\u0456\u0434\u043C\u0456\u043D\u0438\u0442\u0438",
      removeLastVertex: "\u0412\u0438\u0434\u0430\u043B\u0438\u0442\u0438 \u043F\u043E\u043F\u0435\u0440\u0435\u0434\u043D\u044E \u0432\u0435\u0440\u0448\u0438\u043D\u0443"
    },
    buttonTitles: {
      drawMarkerButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043C\u0430\u0440\u043A\u0435\u0440",
      drawPolyButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043F\u043E\u043B\u0456\u0433\u043E\u043D",
      drawLineButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043A\u0440\u0438\u0432\u0443",
      drawCircleButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043A\u043E\u043B\u043E",
      drawRectButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043F\u0440\u044F\u043C\u043E\u043A\u0443\u0442\u043D\u0438\u043A",
      editButton: "\u0420\u0435\u0434\u0430\u0433\u0443\u0432\u0430\u0442\u0438 \u0448\u0430\u0440\u0438",
      dragButton: "\u041F\u0435\u0440\u0435\u043D\u0435\u0441\u0442\u0438 \u0448\u0430\u0440\u0438",
      cutButton: "\u0412\u0438\u0440\u0456\u0437\u0430\u0442\u0438 \u0448\u0430\u0440\u0438",
      deleteButton: "\u0412\u0438\u0434\u0430\u043B\u0438\u0442\u0438 \u0448\u0430\u0440\u0438",
      drawCircleMarkerButton: "\u041C\u0430\u043B\u044E\u0432\u0430\u0442\u0438 \u043A\u0440\u0443\u0433\u043E\u0432\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440",
      snappingButton: "\u041F\u0440\u0438\u0432\u2019\u044F\u0437\u0430\u0442\u0438 \u043F\u0435\u0440\u0435\u0442\u044F\u0433\u043D\u0443\u0442\u0438\u0439 \u043C\u0430\u0440\u043A\u0435\u0440 \u0434\u043E \u0456\u043D\u0448\u0438\u0445 \u0448\u0430\u0440\u0456\u0432 \u0442\u0430 \u0432\u0435\u0440\u0448\u0438\u043D",
      pinningButton: "\u0417\u0432'\u044F\u0437\u0430\u0442\u0438 \u0441\u043F\u0456\u043B\u044C\u043D\u0456 \u0432\u0435\u0440\u0448\u0438\u043D\u0438 \u0440\u0430\u0437\u043E\u043C",
      rotateButton: "\u041F\u043E\u0432\u0435\u0440\u043D\u0443\u0442\u0438 \u0448\u0430\u0440"
    }
  };

  // src/assets/translations/tr.json
  var tr_default = {
    tooltips: {
      placeMarker: "\u0130\u015Faret\xE7i yerle\u015Ftirmek i\xE7in t\u0131klay\u0131n",
      placeMarkerTouch: "\u0130\u015Faret\xE7i yerle\u015Ftirmek i\xE7in haritaya dokunun",
      firstVertex: "\u0130lk tepe noktas\u0131n\u0131 yerle\u015Ftirmek i\xE7in t\u0131klay\u0131n",
      continueLine: "\xC7izime devam etmek i\xE7in t\u0131klay\u0131n",
      finishLine: "Bitirmek i\xE7in mevcut herhangi bir i\u015Faret\xE7iyi t\u0131klay\u0131n",
      finishPoly: "Bitirmek i\xE7in ilk i\u015Faret\xE7iyi t\u0131klay\u0131n",
      finishRect: "Bitirmek i\xE7in t\u0131klay\u0131n",
      startCircle: "Daire merkezine yerle\u015Ftirmek i\xE7in t\u0131klay\u0131n",
      finishCircle: "Daireyi bitirmek i\xE7in t\u0131klay\u0131n",
      placeCircleMarker: "Daire i\u015Faret\xE7isi yerle\u015Ftirmek i\xE7in t\u0131klay\u0131n"
    },
    actions: {
      finish: "Bitir",
      cancel: "\u0130ptal",
      removeLastVertex: "Son k\xF6\u015Feyi kald\u0131r"
    },
    buttonTitles: {
      drawMarkerButton: "\xC7izim \u0130\u015Faret\xE7isi",
      drawPolyButton: "\xC7okgenler \xE7iz",
      drawLineButton: "\xC7oklu \xE7izgi \xE7iz",
      drawCircleButton: "\xC7ember \xE7iz",
      drawRectButton: "Dikd\xF6rtgen \xE7iz",
      editButton: "Katmanlar\u0131 d\xFCzenle",
      dragButton: "Katmanlar\u0131 s\xFCr\xFCkle",
      cutButton: "Katmanlar\u0131 kes",
      deleteButton: "Katmanlar\u0131 kald\u0131r",
      drawCircleMarkerButton: "Daire i\u015Faret\xE7isi \xE7iz",
      snappingButton: "S\xFCr\xFCklenen i\u015Faret\xE7iyi di\u011Fer katmanlara ve k\xF6\u015Felere yap\u0131\u015Ft\u0131r",
      pinningButton: "Payla\u015F\u0131lan k\xF6\u015Feleri birbirine sabitle",
      rotateButton: "Katman\u0131 d\xF6nd\xFCr"
    }
  };

  // src/assets/translations/cz.json
  var cz_default = {
    tooltips: {
      placeMarker: "Kliknut\xEDm vytvo\u0159\xEDte zna\u010Dku",
      placeMarkerTouch: "Klepnut\xEDm na mapu um\xEDst\xEDte zna\u010Dku",
      firstVertex: "Kliknut\xEDm vytvo\u0159\xEDte prvn\xED objekt",
      continueLine: "Kliknut\xEDm pokra\u010Dujte v kreslen\xED",
      finishLine: "Kliknut\xED na libovolnou existuj\xEDc\xED zna\u010Dku pro dokon\u010Den\xED",
      finishPoly: "Vyberte prvn\xED bod pro dokon\u010Den\xED",
      finishRect: "Klikn\u011Bte pro dokon\u010Den\xED",
      startCircle: "Kliknut\xEDm p\u0159idejte st\u0159ed kruhu",
      finishCircle: "\u041D\u0430\u0436\u043C\u0438\u0442\u0435, \u0447\u0442\u043E\u0431\u044B \u0437\u0430\u0434\u0430\u0442\u044C \u0440\u0430\u0434\u0438\u0443\u0441",
      placeCircleMarker: "Kliknut\xEDm nastavte polom\u011Br"
    },
    actions: {
      finish: "Dokon\u010Dit",
      cancel: "Zru\u0161it",
      removeLastVertex: "Zru\u0161it posledn\xED akci"
    },
    buttonTitles: {
      drawMarkerButton: "P\u0159idat zna\u010Dku",
      drawPolyButton: "Nakreslit polygon",
      drawLineButton: "Nakreslit k\u0159ivku",
      drawCircleButton: "Nakreslit kruh",
      drawRectButton: "Nakreslit obd\xE9ln\xEDk",
      editButton: "Upravit vrstvu",
      dragButton: "P\u0159eneste vrstvu",
      cutButton: "Vyjmout vrstvu",
      deleteButton: "Smazat vrstvu",
      drawCircleMarkerButton: "P\u0159idat kruhovou zna\u010Dku",
      snappingButton: "Nav\xE1zat ta\u017Enou zna\u010Dku k dal\u0161\xEDm vrstv\xE1m a vrchol\u016Fm",
      pinningButton: "Spojit spole\u010Dn\xE9 body dohromady",
      rotateButton: "Oto\u010Dte vrstvu"
    }
  };

  // src/assets/translations/ja.json
  var ja_default = {
    tooltips: {
      placeMarker: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u30DE\u30FC\u30AB\u30FC\u3092\u914D\u7F6E",
      placeMarkerTouch: "\u5730\u56F3\u3092\u30BF\u30C3\u30D7\u3057\u3066\u30DE\u30FC\u30AB\u30FC\u3092\u914D\u7F6E",
      firstVertex: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u6700\u521D\u306E\u9802\u70B9\u3092\u914D\u7F6E",
      continueLine: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u63CF\u753B\u3092\u7D9A\u3051\u308B",
      finishLine: "\u4EFB\u610F\u306E\u30DE\u30FC\u30AB\u30FC\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u7D42\u4E86",
      finishPoly: "\u6700\u521D\u306E\u30DE\u30FC\u30AB\u30FC\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u7D42\u4E86",
      finishRect: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u7D42\u4E86",
      startCircle: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u5186\u306E\u4E2D\u5FC3\u3092\u914D\u7F6E",
      finishCircle: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u5186\u306E\u63CF\u753B\u3092\u7D42\u4E86",
      placeCircleMarker: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u5186\u30DE\u30FC\u30AB\u30FC\u3092\u914D\u7F6E",
      placeText: "\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u30C6\u30AD\u30B9\u30C8\u3092\u914D\u7F6E"
    },
    actions: {
      finish: "\u7D42\u4E86",
      cancel: "\u30AD\u30E3\u30F3\u30BB\u30EB",
      removeLastVertex: "\u6700\u5F8C\u306E\u9802\u70B9\u3092\u524A\u9664"
    },
    buttonTitles: {
      drawMarkerButton: "\u30DE\u30FC\u30AB\u30FC\u3092\u63CF\u753B",
      drawPolyButton: "\u30DD\u30EA\u30B4\u30F3\u3092\u63CF\u753B",
      drawLineButton: "\u6298\u308C\u7DDA\u3092\u63CF\u753B",
      drawCircleButton: "\u5186\u3092\u63CF\u753B",
      drawRectButton: "\u77E9\u5F62\u3092\u63CF\u753B",
      editButton: "\u30EC\u30A4\u30E4\u30FC\u3092\u7DE8\u96C6",
      dragButton: "\u30EC\u30A4\u30E4\u30FC\u3092\u30C9\u30E9\u30C3\u30B0",
      cutButton: "\u30EC\u30A4\u30E4\u30FC\u3092\u5207\u308A\u53D6\u308A",
      deleteButton: "\u30EC\u30A4\u30E4\u30FC\u3092\u524A\u9664",
      drawCircleMarkerButton: "\u5186\u30DE\u30FC\u30AB\u30FC\u3092\u63CF\u753B",
      snappingButton: "\u30C9\u30E9\u30C3\u30B0\u3057\u305F\u30DE\u30FC\u30AB\u30FC\u3092\u4ED6\u306E\u30EC\u30A4\u30E4\u30FC\u3084\u9802\u70B9\u306B\u30B9\u30CA\u30C3\u30D7\u3059\u308B",
      pinningButton: "\u5171\u6709\u3059\u308B\u9802\u70B9\u3092\u540C\u6642\u306B\u52D5\u304B\u3059",
      rotateButton: "\u30EC\u30A4\u30E4\u30FC\u3092\u56DE\u8EE2",
      drawTextButton: "\u30C6\u30AD\u30B9\u30C8\u3092\u63CF\u753B"
    }
  };

  // src/assets/translations/fi.json
  var fi_default = {
    tooltips: {
      placeMarker: "Klikkaa asettaaksesi merkin",
      placeMarkerTouch: "Napauta karttaa asettaaksesi merkin",
      firstVertex: "Klikkaa asettaakseni ensimm\xE4isen osuuden",
      continueLine: "Klikkaa jatkaaksesi piirt\xE4mist\xE4",
      finishLine: "Klikkaa olemassa olevaa merkki\xE4 lopettaaksesi",
      finishPoly: "Klikkaa ensimm\xE4ist\xE4 merkki\xE4 lopettaaksesi",
      finishRect: "Klikkaa lopettaaksesi",
      startCircle: "Klikkaa asettaaksesi ympyr\xE4n keskipisteen",
      finishCircle: "Klikkaa lopettaaksesi ympyr\xE4n",
      placeCircleMarker: "Klikkaa asettaaksesi ympyr\xE4merkin",
      placeText: "Klikkaa asettaaksesi tekstin"
    },
    actions: {
      finish: "Valmis",
      cancel: "Peruuta",
      removeLastVertex: "Poista viimeinen osuus"
    },
    buttonTitles: {
      drawMarkerButton: "Piirr\xE4 merkkej\xE4",
      drawPolyButton: "Piirr\xE4 monikulmioita",
      drawLineButton: "Piirr\xE4 viivoja",
      drawCircleButton: "Piirr\xE4 ympyr\xE4",
      drawRectButton: "Piirr\xE4 neliskulmioita",
      editButton: "Muokkaa",
      dragButton: "Siirr\xE4",
      cutButton: "Leikkaa",
      deleteButton: "Poista",
      drawCircleMarkerButton: "Piirr\xE4 ympyr\xE4merkki",
      snappingButton: "Kiinnit\xE4 siirrett\xE4v\xE4 merkki toisiin muotoihin",
      pinningButton: "Kiinnit\xE4 jaetut muodot yhteen",
      rotateButton: "K\xE4\xE4nn\xE4",
      drawTextButton: "Piirr\xE4 teksti\xE4"
    }
  };

  // src/assets/translations/ko.json
  var ko_default = {
    tooltips: {
      placeMarker: "\uB9C8\uCEE4 \uC704\uCE58\uB97C \uD074\uB9AD\uD558\uC138\uC694",
      placeMarkerTouch: "\uC9C0\uB3C4\uB97C \uD0ED\uD558\uC5EC \uB9C8\uCEE4\uB97C \uBC30\uCE58\uD558\uC138\uC694",
      firstVertex: "\uCCAB\uBC88\uC9F8 \uAF2D\uC9C0\uC810 \uC704\uCE58\uC744 \uD074\uB9AD\uD558\uC138\uC694",
      continueLine: "\uACC4\uC18D \uADF8\uB9AC\uB824\uBA74 \uD074\uB9AD\uD558\uC138\uC694",
      finishLine: "\uB05D\uB0B4\uB824\uBA74 \uAE30\uC874 \uB9C8\uCEE4\uB97C \uD074\uB9AD\uD558\uC138\uC694",
      finishPoly: "\uB05D\uB0B4\uB824\uBA74 \uCC98\uC74C \uB9C8\uCEE4\uB97C \uD074\uB9AD\uD558\uC138\uC694",
      finishRect: "\uB05D\uB0B4\uB824\uBA74 \uD074\uB9AD\uD558\uC138\uC694",
      startCircle: "\uC6D0\uC758 \uC911\uC2EC\uC774 \uB420 \uC704\uCE58\uB97C \uD074\uB9AD\uD558\uC138\uC694",
      finishCircle: "\uC6D0\uC744 \uB05D\uB0B4\uB824\uBA74 \uD074\uB9AD\uD558\uC138\uC694",
      placeCircleMarker: "\uC6D0 \uB9C8\uCEE4 \uC704\uCE58\uB97C \uD074\uB9AD\uD558\uC138\uC694",
      placeText: "\uD14D\uC2A4\uD2B8 \uC704\uCE58\uB97C \uD074\uB9AD\uD558\uC138\uC694"
    },
    actions: {
      finish: "\uB05D\uB0B4\uAE30",
      cancel: "\uCDE8\uC18C",
      removeLastVertex: "\uB9C8\uC9C0\uB9C9 \uAF2D\uC9C0\uC810 \uC81C\uAC70"
    },
    buttonTitles: {
      drawMarkerButton: "\uB9C8\uCEE4 \uADF8\uB9AC\uAE30",
      drawPolyButton: "\uB2E4\uAC01\uD615 \uADF8\uB9AC\uAE30",
      drawLineButton: "\uB2E4\uAC01\uC120 \uADF8\uB9AC\uAE30",
      drawCircleButton: "\uC6D0 \uADF8\uB9AC\uAE30",
      drawRectButton: "\uC9C1\uC0AC\uAC01\uD615 \uADF8\uB9AC\uAE30",
      editButton: "\uB808\uC774\uC5B4 \uD3B8\uC9D1\uD558\uAE30",
      dragButton: "\uB808\uC774\uC5B4 \uB04C\uAE30",
      cutButton: "\uB808\uC774\uC5B4 \uC790\uB974\uAE30",
      deleteButton: "\uB808\uC774\uC5B4 \uC81C\uAC70\uD558\uAE30",
      drawCircleMarkerButton: "\uC6D0 \uB9C8\uCEE4 \uADF8\uB9AC\uAE30",
      snappingButton: "\uC7A1\uC544\uB048 \uB9C8\uCEE4\uB97C \uB2E4\uB978 \uB808\uC774\uC5B4 \uBC0F \uAF2D\uC9C0\uC810\uC5D0 \uB4E4\uB7EC\uBD99\uAC8C \uD558\uAE30",
      pinningButton: "\uACF5\uC720 \uAF2D\uC9C0\uC810\uC744 \uD568\uAED8 \uCC0D\uAE30",
      rotateButton: "\uB808\uC774\uC5B4 \uD68C\uC804\uD558\uAE30",
      drawTextButton: "\uD14D\uC2A4\uD2B8 \uADF8\uB9AC\uAE30"
    }
  };

  // src/assets/translations/ky.json
  var ky_default = {
    tooltips: {
      placeMarker: "\u041C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      placeMarkerTouch: "\u041C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443 \u04AF\u0447\u04AF\u043D \u043A\u0430\u0440\u0442\u0430\u0433\u0430 \u0442\u0438\u0439\u0438\u04A3\u0438\u0437",
      firstVertex: "\u0411\u0438\u0440\u0438\u043D\u0447\u0438 \u0447\u043E\u043A\u0443\u043D\u0443 \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443\u043D\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      continueLine: "\u0421\u04AF\u0440\u04E9\u0442 \u0442\u0430\u0440\u0442\u0443\u0443\u043D\u0443 \u0443\u043B\u0430\u043D\u0442\u0443\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      finishLine: "\u0410\u044F\u043A\u0442\u043E\u043E \u04AF\u0447\u04AF\u043D \u0443\u0447\u0443\u0440\u0434\u0430\u0433\u044B \u043C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      finishPoly: "\u0411\u04AF\u0442\u04AF\u0440\u04AF\u04AF \u04AF\u0447\u04AF\u043D \u0431\u0438\u0440\u0438\u043D\u0447\u0438 \u043C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      finishRect: "\u0411\u04AF\u0442\u04AF\u0440\u04AF\u04AF \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      startCircle: "\u0410\u0439\u043B\u0430\u043D\u0430\u043D\u044B\u043D \u0431\u043E\u0440\u0431\u043E\u0440\u0443\u043D \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443\u043D\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      finishCircle: "\u0410\u0439\u043B\u0430\u043D\u0430\u043D\u044B \u0431\u04AF\u0442\u04AF\u0440\u04AF\u04AF \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      placeCircleMarker: "\u0422\u0435\u0433\u0435\u0440\u0435\u043A \u043C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437",
      placeText: "\u0422\u0435\u043A\u0441\u0442\u0442\u0438 \u0436\u0430\u0439\u0433\u0430\u0448\u0442\u044B\u0440\u0443\u0443 \u04AF\u0447\u04AF\u043D \u0431\u0430\u0441\u044B\u04A3\u044B\u0437"
    },
    actions: {
      finish: "\u0410\u044F\u0433\u044B",
      cancel: "\u0416\u043E\u043A \u043A\u044B\u043B\u0443\u0443",
      removeLastVertex: "\u0410\u043A\u044B\u0440\u043A\u044B \u0447\u043E\u043A\u0443\u043D\u0443 \u04E9\u0447\u04AF\u0440\u04AF\u04AF"
    },
    buttonTitles: {
      drawMarkerButton: "\u041C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0447\u0438\u0437\u0443\u0443",
      drawPolyButton: "\u041F\u043E\u043B\u0438\u0433\u043E\u043D \u0447\u0438\u0437\u0443\u0443",
      drawLineButton: "\u041F\u043E\u043B\u0438\u043B\u0438\u043D\u0438\u044F \u0447\u0438\u0437\u0443\u0443",
      drawCircleButton: "\u0414\u0430\u0439\u044B\u043D\u0434\u044B \u0447\u0438\u0437\u0443\u0443",
      drawRectButton: "\u041F\u0440\u044F\u043C\u043E\u0443\u0433\u043E\u043B\u044C\u043D\u0438\u043A \u0447\u0438\u0437\u0443\u0443",
      editButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443 \u0442\u04AF\u0437\u04E9\u0442\u04AF\u04AF",
      dragButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443 \u043A\u0430\u0440\u0430\u043F \u0441\u04AF\u0439\u043B\u04E9\u04AF",
      cutButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443\u043D \u0431\u0430\u0448\u044B\u043D \u043A\u0435\u0441\u04AF\u04AF",
      deleteButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443\u043D \u04E9\u0447\u04AF\u0440\u04AF\u04AF",
      drawCircleMarkerButton: "\u0414\u0430\u0439\u044B\u043D\u0434\u044B \u043C\u0430\u0440\u043A\u0435\u0440\u0434\u0438 \u0447\u0438\u0437\u0443\u0443",
      snappingButton: "\u0411\u0430\u0448\u043A\u0430 \u0441\u043B\u043E\u043E\u043F\u0442\u043E\u0440\u0434\u0443\u043D \u0436\u0430\u043D\u0430 \u0432\u0435\u0440\u0442\u0435\u043A\u0441\u0442\u0435\u0440\u0434\u0438\u043D \u0430\u0440\u0430\u0441\u044B\u043D\u0430 \u0447\u0435\u043A\u0438\u043B\u0434\u04E9\u04E9",
      pinningButton: "\u0411\u04E9\u043B\u04AF\u0448\u043A\u04E9\u043D \u0432\u0435\u0440\u0442\u0435\u043A\u0441\u0442\u0435\u0440\u0434\u0438 \u0431\u0438\u0440\u0433\u0435 \u0442\u0443\u0442\u0443\u0448\u0442\u0443\u0440\u0443\u0443",
      rotateButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443\u043D \u04E9\u0437\u0433\u04E9\u0440\u0442\u04AF\u04AF",
      drawTextButton: "\u0422\u0435\u043A\u0441\u0442 \u0447\u0438\u0437\u0443\u0443",
      scaleButton: "\u0421\u043B\u043E\u043E\u043F\u0442\u0443\u043D \u04E9\u043B\u0447\u04E9\u043C\u04AF\u043D \u04E9\u0437\u0433\u04E9\u0440\u0442\u04AF\u04AF",
      autoTracingButton: "\u0410\u0432\u0442\u043E\u043C\u0430\u0442\u0442\u044B\u043A \u0442\u0438\u0437\u043C\u0435\u0433\u0438 \u0447\u0438\u0437\u0443\u0443"
    },
    measurements: {
      totalLength: "\u0423\u0437\u0443\u043D\u0434\u0443\u043A",
      segmentLength: "\u0421\u0435\u0433\u043C\u0435\u043D\u0442 \u0443\u0437\u0443\u043D\u0434\u0443\u0433\u0443",
      area: "\u0410\u0439\u043C\u0430\u043A",
      radius: "\u0420\u0430\u0434\u0438\u0443\u0441",
      perimeter: "\u041F\u0435\u0440\u0438\u043C\u0435\u0442\u0440",
      height: "\u0414\u0438\u0430\u043C\u0435\u0442\u0440",
      width: "\u041A\u0435\u043D\u0447\u0438\u043B\u0438\u043A",
      coordinates: "\u041A\u043E\u043E\u0440\u0434\u0438\u043D\u0430\u0442\u0442\u0430\u0440",
      coordinatesMarker: "\u041C\u0430\u0440\u043A\u0435\u0440\u0434\u0438\u043D \u043A\u043E\u043E\u0440\u0434\u0438\u043D\u0430\u0442\u0442\u0430\u0440\u044B"
    }
  };

  // src/assets/translations/index.ts
  var pt = pt_pt_default;
  var translations_default = {
    en: en_default,
    de: de_default,
    it: it_default,
    id: id_default,
    ro: ro_default,
    ru: ru_default,
    es: es_default,
    nl: nl_default,
    fr: fr_default,
    pt,
    pt_br: pt_br_default,
    pt_pt: pt_pt_default,
    zh: zh_default,
    zh_tw: zh_tw_default,
    pl: pl_default,
    sv: sv_default,
    el: el_default,
    hu: hu_default,
    da: da_default,
    no: no_default,
    fa: fa_default,
    ua: ua_default,
    tr: tr_default,
    cz: cz_default,
    ja: ja_default,
    fi: fi_default,
    ko: ko_default,
    ky: ky_default
  };

  // src/js/Mixins/Modes/Mode.Edit.ts
  var GlobalEditMode = {
    _globalEditModeEnabled: false,
    enableGlobalEditMode(o) {
      const options = {
        ...o
      };
      this._globalEditModeEnabled = true;
      this.Toolbar.toggleButton("editMode", this.globalEditModeEnabled());
      const layers = L.PM.Utils.findLayers(this.map);
      layers.forEach((layer) => {
        if (this._isRelevantForEdit(layer)) {
          layer.pm.enable(options);
        }
      });
      if (!this.throttledReInitEdit) {
        this.throttledReInitEdit = L.Util.throttle(
          this.handleLayerAdditionInGlobalEditMode,
          100,
          this
        );
      }
      this._addedLayersEdit = {};
      this.map.on("layeradd", this._layerAddedEdit, this);
      this.map.on("layeradd", this.throttledReInitEdit, this);
      this._fireGlobalEditModeToggled(true);
    },
    disableGlobalEditMode() {
      this._globalEditModeEnabled = false;
      const layers = L.PM.Utils.findLayers(this.map);
      layers.forEach((layer) => {
        layer.pm.disable();
      });
      this.map.off("layeradd", this._layerAddedEdit, this);
      this.map.off("layeradd", this.throttledReInitEdit, this);
      this.Toolbar.toggleButton("editMode", this.globalEditModeEnabled());
      this._fireGlobalEditModeToggled(false);
    },
    // TODO: Remove in the next major release
    globalEditEnabled() {
      return this.globalEditModeEnabled();
    },
    globalEditModeEnabled() {
      return this._globalEditModeEnabled;
    },
    // TODO: this should maybe removed, it will overwrite explicit options on the layers
    toggleGlobalEditMode(options = this.globalOptions) {
      if (this.globalEditModeEnabled()) {
        this.disableGlobalEditMode();
      } else {
        this.enableGlobalEditMode(options);
      }
    },
    handleLayerAdditionInGlobalEditMode() {
      const layers = this._addedLayersEdit;
      this._addedLayersEdit = {};
      if (this.globalEditModeEnabled()) {
        for (const id in layers) {
          const layer = layers[id];
          if (this._isRelevantForEdit(layer)) {
            layer.pm.enable({ ...this.globalOptions });
          }
        }
      }
    },
    _layerAddedEdit({ layer }) {
      this._addedLayersEdit[L.stamp(layer)] = layer;
    },
    _isRelevantForEdit(layer) {
      return layer.pm && !(layer instanceof L.LayerGroup) && (!L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
      L.PM.optIn && layer.options.pmIgnore === false) && // if optIn is true and pmIgnore is false
      !layer._pmTempLayer && layer.pm.options.allowEditing;
    }
  };
  var Mode_Edit_default = GlobalEditMode;

  // src/js/Mixins/Modes/Mode.Drag.ts
  var GlobalDragMode = {
    _globalDragModeEnabled: false,
    enableGlobalDragMode() {
      const layers = L.PM.Utils.findLayers(this.map);
      this._globalDragModeEnabled = true;
      this._addedLayersDrag = {};
      layers.forEach((layer) => {
        if (this._isRelevantForDrag(layer)) {
          layer.pm.enableLayerDrag();
        }
      });
      if (!this.throttledReInitDrag) {
        this.throttledReInitDrag = L.Util.throttle(
          this.reinitGlobalDragMode,
          100,
          this
        );
      }
      this.map.on("layeradd", this._layerAddedDrag, this);
      this.map.on("layeradd", this.throttledReInitDrag, this);
      this.Toolbar.toggleButton("dragMode", this.globalDragModeEnabled());
      this._fireGlobalDragModeToggled(true);
    },
    disableGlobalDragMode() {
      const layers = L.PM.Utils.findLayers(this.map);
      this._globalDragModeEnabled = false;
      layers.forEach((layer) => {
        layer.pm.disableLayerDrag();
      });
      this.map.off("layeradd", this._layerAddedDrag, this);
      this.map.off("layeradd", this.throttledReInitDrag, this);
      this.Toolbar.toggleButton("dragMode", this.globalDragModeEnabled());
      this._fireGlobalDragModeToggled(false);
    },
    globalDragModeEnabled() {
      return !!this._globalDragModeEnabled;
    },
    toggleGlobalDragMode() {
      if (this.globalDragModeEnabled()) {
        this.disableGlobalDragMode();
      } else {
        this.enableGlobalDragMode();
      }
    },
    reinitGlobalDragMode() {
      const layers = this._addedLayersDrag;
      this._addedLayersDrag = {};
      if (this.globalDragModeEnabled()) {
        for (const id in layers) {
          const layer = layers[id];
          if (this._isRelevantForDrag(layer)) {
            layer.pm.enableLayerDrag();
          }
        }
      }
    },
    _layerAddedDrag({ layer }) {
      this._addedLayersDrag[L.stamp(layer)] = layer;
    },
    _isRelevantForDrag(layer) {
      return layer.pm && !(layer instanceof L.LayerGroup) && (!L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
      L.PM.optIn && layer.options.pmIgnore === false) && // if optIn is true and pmIgnore is false
      !layer._pmTempLayer && layer.pm.options.draggable;
    }
  };
  var Mode_Drag_default = GlobalDragMode;

  // src/js/Mixins/Modes/Mode.Removal.ts
  var GlobalRemovalMode = {
    _globalRemovalModeEnabled: false,
    enableGlobalRemovalMode() {
      this._globalRemovalModeEnabled = true;
      this.map.eachLayer((layer) => {
        if (this._isRelevantForRemoval(layer)) {
          if (layer.pm.enabled()) {
            layer.pm.disable();
          }
          layer.on("click", this.removeLayer, this);
        }
      });
      if (!this.throttledReInitRemoval) {
        this.throttledReInitRemoval = L.Util.throttle(
          this.handleLayerAdditionInGlobalRemovalMode,
          100,
          this
        );
      }
      this._addedLayersRemoval = {};
      this.map.on("layeradd", this._layerAddedRemoval, this);
      this.map.on("layeradd", this.throttledReInitRemoval, this);
      this.Toolbar.toggleButton("removalMode", this.globalRemovalModeEnabled());
      this._fireGlobalRemovalModeToggled(true);
    },
    disableGlobalRemovalMode() {
      this._globalRemovalModeEnabled = false;
      this.map.eachLayer((layer) => {
        layer.off("click", this.removeLayer, this);
      });
      this.map.off("layeradd", this._layerAddedRemoval, this);
      this.map.off("layeradd", this.throttledReInitRemoval, this);
      this.Toolbar.toggleButton("removalMode", this.globalRemovalModeEnabled());
      this._fireGlobalRemovalModeToggled(false);
    },
    // TODO: Remove in the next major release
    globalRemovalEnabled() {
      return this.globalRemovalModeEnabled();
    },
    globalRemovalModeEnabled() {
      return !!this._globalRemovalModeEnabled;
    },
    toggleGlobalRemovalMode() {
      if (this.globalRemovalModeEnabled()) {
        this.disableGlobalRemovalMode();
      } else {
        this.enableGlobalRemovalMode();
      }
    },
    removeLayer(e) {
      const layer = e.target;
      const removeable = this._isRelevantForRemoval(layer) && !layer.pm.dragging();
      if (removeable) {
        layer.removeFrom(this.map.pm._getContainingLayer());
        layer.remove();
        if (layer instanceof L.LayerGroup) {
          this._fireRemoveLayerGroup(layer);
          this._fireRemoveLayerGroup(this.map, layer);
        } else {
          layer.pm._fireRemove(layer);
          layer.pm._fireRemove(this.map, layer);
        }
      }
    },
    _isRelevantForRemoval(layer) {
      return layer.pm && !(layer instanceof L.LayerGroup) && (!L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
      L.PM.optIn && layer.options.pmIgnore === false) && // if optIn is true and pmIgnore is false
      !layer._pmTempLayer && layer.pm.options.allowRemoval;
    },
    handleLayerAdditionInGlobalRemovalMode() {
      const layers = this._addedLayersRemoval;
      this._addedLayersRemoval = {};
      if (this.globalRemovalModeEnabled()) {
        for (const id in layers) {
          const layer = layers[id];
          if (this._isRelevantForRemoval(layer)) {
            if (layer.pm.enabled()) {
              layer.pm.disable();
            }
            layer.on("click", this.removeLayer, this);
          }
        }
      }
    },
    _layerAddedRemoval({ layer }) {
      this._addedLayersRemoval[L.stamp(layer)] = layer;
    }
  };
  var Mode_Removal_default = GlobalRemovalMode;

  // src/js/Mixins/Modes/Mode.Rotate.ts
  var GlobalRotateMode = {
    _globalRotateModeEnabled: false,
    enableGlobalRotateMode() {
      this._globalRotateModeEnabled = true;
      const layers = L.PM.Utils.findLayers(this.map).filter(
        (l) => l instanceof L.Polyline
      );
      layers.forEach((layer) => {
        if (this._isRelevantForRotate(layer)) {
          layer.pm.enableRotate();
        }
      });
      if (!this.throttledReInitRotate) {
        this.throttledReInitRotate = L.Util.throttle(
          this.handleLayerAdditionInGlobalRotateMode,
          100,
          this
        );
      }
      this._addedLayersRotate = {};
      this.map.on("layeradd", this._layerAddedRotate, this);
      this.map.on("layeradd", this.throttledReInitRotate, this);
      this.Toolbar.toggleButton("rotateMode", this.globalRotateModeEnabled());
      this._fireGlobalRotateModeToggled();
    },
    disableGlobalRotateMode() {
      this._globalRotateModeEnabled = false;
      const layers = L.PM.Utils.findLayers(this.map).filter(
        (l) => l instanceof L.Polyline
      );
      layers.forEach((layer) => {
        layer.pm.disableRotate();
      });
      this.map.off("layeradd", this._layerAddedRotate, this);
      this.map.off("layeradd", this.throttledReInitRotate, this);
      this.Toolbar.toggleButton("rotateMode", this.globalRotateModeEnabled());
      this._fireGlobalRotateModeToggled();
    },
    globalRotateModeEnabled() {
      return !!this._globalRotateModeEnabled;
    },
    toggleGlobalRotateMode() {
      if (this.globalRotateModeEnabled()) {
        this.disableGlobalRotateMode();
      } else {
        this.enableGlobalRotateMode();
      }
    },
    _isRelevantForRotate(layer) {
      return layer.pm && layer instanceof L.Polyline && !(layer instanceof L.LayerGroup) && (!L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
      L.PM.optIn && layer.options.pmIgnore === false) && // if optIn is true and pmIgnore is false
      !layer._pmTempLayer && layer.pm.options.allowRotation;
    },
    handleLayerAdditionInGlobalRotateMode() {
      const layers = this._addedLayersRotate;
      this._addedLayersRotate = {};
      if (this.globalRotateModeEnabled()) {
        for (const id in layers) {
          const layer = layers[id];
          if (this._isRelevantForRotate(layer)) {
            layer.pm.enableRotate();
          }
        }
      }
    },
    _layerAddedRotate({ layer }) {
      this._addedLayersRotate[L.stamp(layer)] = layer;
    }
  };
  var Mode_Rotate_default = GlobalRotateMode;

  // src/js/Mixins/Events.ts
  var import_merge = __toESM(require_merge());
  var EventMixin = {
    // Draw Events
    // Fired when enableDraw() is called -> draw start
    _fireDrawStart(source = "Draw", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:drawstart",
        {
          shape: this._shape,
          workingLayer: this._layer
        },
        source,
        customPayload
      );
    },
    // Fired when disableDraw() is called -> draw stop
    _fireDrawEnd(source = "Draw", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:drawend",
        {
          shape: this._shape
        },
        source,
        customPayload
      );
    },
    // Fired when layer is created while drawing
    _fireCreate(layer, source = "Draw", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:create",
        {
          shape: this._shape,
          marker: layer,
          // TODO: Deprecated
          layer
        },
        source,
        customPayload
      );
    },
    // Fired when Circle / CircleMarker center is placed
    // if source == "Draw" then `workingLayer` is passed else `layer`
    _fireCenterPlaced(source = "Draw", customPayload = {}) {
      const workingLayer = source === "Draw" ? this._layer : void 0;
      const layer = source !== "Draw" ? this._layer : void 0;
      this.__fire(
        this._layer,
        "pm:centerplaced",
        {
          shape: this._shape,
          workingLayer,
          layer,
          latlng: this._layer.getLatLng()
        },
        source,
        customPayload
      );
    },
    // Fired when layer is cutted
    // TODO: is Cut "Draw" or "Edit"? The event `pm:edit` in the same scope is called as source "Edit"
    _fireCut(fireLayer, layer, originalLayer, source = "Draw", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:cut",
        {
          shape: this._shape,
          layer,
          originalLayer
        },
        source,
        customPayload
      );
    },
    // Edit Events
    // Fired when layer is edited / changed
    _fireEdit(fireLayer = this._layer, source = "Edit", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:edit",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when layer is enabled for editing
    _fireEnable(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:enable",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when layer is disabled for editing
    _fireDisable(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:disable",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when layer is disabled and was edited / changed
    _fireUpdate(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:update",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when a vertex-marker is started dragging
    // indexPath is only passed from Line / Polygon
    _fireMarkerDragStart(e, indexPath = void 0, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:markerdragstart",
        {
          layer: this._layer,
          markerEvent: e,
          shape: this.getShape(),
          indexPath
        },
        source,
        customPayload
      );
    },
    // Fired while dragging a vertex-marker
    // indexPath is only passed from Line / Polygon
    _fireMarkerDrag(e, indexPath = void 0, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:markerdrag",
        {
          layer: this._layer,
          markerEvent: e,
          shape: this.getShape(),
          indexPath
        },
        source,
        customPayload
      );
    },
    // Fired when a vertex-marker is stopped dragging
    // indexPath and intersectionReset is only passed from Line / Polygon
    _fireMarkerDragEnd(e, indexPath = void 0, intersectionReset = void 0, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:markerdragend",
        {
          layer: this._layer,
          markerEvent: e,
          shape: this.getShape(),
          indexPath,
          intersectionReset
        },
        source,
        customPayload
      );
    },
    // Fired when a layer is started dragging
    _fireDragStart(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:dragstart",
        {
          layer: this._layer,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired while dragging a layer
    _fireDrag(e, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:drag",
        { ...e, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when a layer is stopped dragging
    _fireDragEnd(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:dragend",
        {
          layer: this._layer,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when layer is enabled for editing
    _fireDragEnable(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:dragenable",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when layer is disabled for editing
    _fireDragDisable(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:dragdisable",
        { layer: this._layer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when a layer is removed
    _fireRemove(fireLayer, refLayer = fireLayer, source = "Edit", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:remove",
        { layer: refLayer, shape: this.getShape() },
        source,
        customPayload
      );
    },
    // Fired when a vertex-marker is created
    _fireVertexAdded(marker, indexPath, latlng, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:vertexadded",
        {
          layer: this._layer,
          workingLayer: this._layer,
          marker,
          indexPath,
          latlng,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when a vertex-marker is removed
    _fireVertexRemoved(marker, indexPath, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:vertexremoved",
        {
          layer: this._layer,
          marker,
          indexPath,
          shape: this.getShape()
          // TODO: maybe add latlng as well?
        },
        source,
        customPayload
      );
    },
    // Fired when a vertex-marker is clicked
    _fireVertexClick(e, indexPath, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:vertexclick",
        {
          layer: this._layer,
          markerEvent: e,
          indexPath,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when a Line / Polygon has self intersection
    _fireIntersect(intersection3, fireLayer = this._layer, source = "Edit", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:intersect",
        {
          layer: this._layer,
          intersection: intersection3,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when coords of a layer are reset. E.g. by self-intersection
    _fireLayerReset(e, indexPath, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:layerreset",
        {
          layer: this._layer,
          markerEvent: e,
          indexPath,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired coordinates of the layer changed
    _fireChange(latlngs, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:change",
        {
          layer: this._layer,
          latlngs,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when text of a text layer changed
    _fireTextChange(text, source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:textchange",
        {
          layer: this._layer,
          text,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when text layer focused
    _fireTextFocus(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:textfocus",
        {
          layer: this._layer,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when text layer blurred
    _fireTextBlur(source = "Edit", customPayload = {}) {
      this.__fire(
        this._layer,
        "pm:textblur",
        {
          layer: this._layer,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Snapping Events
    // Fired during a marker move/drag and other layers are existing
    _fireSnapDrag(fireLayer, eventInfo, source = "Snapping", customPayload = {}) {
      this.__fire(fireLayer, "pm:snapdrag", eventInfo, source, customPayload);
    },
    // Fired when a vertex is snapped
    _fireSnap(fireLayer, eventInfo, source = "Snapping", customPayload = {}) {
      this.__fire(fireLayer, "pm:snap", eventInfo, source, customPayload);
    },
    // Fired when a vertex is unsnapped
    _fireUnsnap(fireLayer, eventInfo, source = "Snapping", customPayload = {}) {
      this.__fire(fireLayer, "pm:unsnap", eventInfo, source, customPayload);
    },
    // Rotation Events
    // Fired when rotation is enabled
    _fireRotationEnable(fireLayer, helpLayer, source = "Rotation", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:rotateenable",
        {
          layer: this._layer,
          helpLayer: this._rotatePoly,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when rotation is disabled
    _fireRotationDisable(fireLayer, source = "Rotation", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:rotatedisable",
        {
          layer: this._layer,
          shape: this.getShape()
        },
        source,
        customPayload
      );
    },
    // Fired when rotation starts
    _fireRotationStart(fireLayer, originLatLngs, source = "Rotation", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:rotatestart",
        {
          layer: this._rotationLayer,
          helpLayer: this._layer,
          startAngle: this._startAngle,
          originLatLngs
        },
        source,
        customPayload
      );
    },
    // Fired while rotation
    _fireRotation(fireLayer, angleDiff, oldLatLngs, rotationLayer = this._rotationLayer, source = "Rotation", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:rotate",
        {
          layer: rotationLayer,
          helpLayer: this._layer,
          startAngle: this._startAngle,
          angle: rotationLayer.pm.getAngle(),
          angleDiff,
          oldLatLngs,
          newLatLngs: rotationLayer.getLatLngs()
        },
        source,
        customPayload
      );
    },
    // Fired when rotation ends
    _fireRotationEnd(fireLayer, startAngle, originLatLngs, source = "Rotation", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:rotateend",
        {
          layer: this._rotationLayer,
          helpLayer: this._layer,
          startAngle,
          angle: this._rotationLayer.pm.getAngle(),
          originLatLngs,
          newLatLngs: this._rotationLayer.getLatLngs()
        },
        source,
        customPayload
      );
    },
    // Global Events
    // Fired when a Toolbar action is clicked
    _fireActionClick(action, btnName, button, source = "Toolbar", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:actionclick",
        {
          text: action.text,
          action,
          btnName,
          button
        },
        source,
        customPayload
      );
    },
    // Fired when a Toolbar button is clicked
    _fireButtonClick(btnName, button, source = "Toolbar", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:buttonclick",
        { btnName, button },
        source,
        customPayload
      );
    },
    // Fired when language is changed
    _fireLangChange(oldLang, activeLang, fallback, translations, source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:langchange",
        {
          oldLang,
          activeLang,
          fallback,
          translations
        },
        source,
        customPayload
      );
    },
    // Fired when Drag Mode is toggled.
    _fireGlobalDragModeToggled(enabled, source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:globaldragmodetoggled",
        {
          enabled,
          map: this.map
        },
        source,
        customPayload
      );
    },
    // Fired when Edit Mode is toggled.
    _fireGlobalEditModeToggled(enabled, source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:globaleditmodetoggled",
        {
          enabled,
          map: this.map
        },
        source,
        customPayload
      );
    },
    // Fired when Removal Mode is toggled.
    _fireGlobalRemovalModeToggled(enabled, source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:globalremovalmodetoggled",
        {
          enabled,
          map: this.map
        },
        source,
        customPayload
      );
    },
    // Fired when Cut Mode is toggled.
    _fireGlobalCutModeToggled(source = "Global", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:globalcutmodetoggled",
        {
          enabled: !!this._enabled,
          map: this._map
        },
        source,
        customPayload
      );
    },
    // Fired when Draw Mode is toggled.
    _fireGlobalDrawModeToggled(source = "Global", customPayload = {}) {
      this.__fire(
        this._map,
        "pm:globaldrawmodetoggled",
        {
          enabled: this._enabled,
          shape: this._shape,
          map: this._map
        },
        source,
        customPayload
      );
    },
    // Fired when Rotation Mode is toggled.
    _fireGlobalRotateModeToggled(source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:globalrotatemodetoggled",
        {
          enabled: this.globalRotateModeEnabled(),
          map: this.map
        },
        source,
        customPayload
      );
    },
    // Fired when LayerGroup is removed
    _fireRemoveLayerGroup(fireLayer, refLayer = fireLayer, source = "Edit", customPayload = {}) {
      this.__fire(
        fireLayer,
        "pm:remove",
        { layer: refLayer, shape: void 0 },
        source,
        customPayload
      );
    },
    // Fired when `keydown` or `keyup` on the document is fired.
    _fireKeyeventEvent(event, eventType, focusOn, source = "Global", customPayload = {}) {
      this.__fire(
        this.map,
        "pm:keyevent",
        {
          event,
          eventType,
          focusOn
        },
        source,
        customPayload
      );
    },
    // private (very private) fire function
    __fire(fireLayer, type, payload, source, customPayload = {}) {
      payload = (0, import_merge.default)(payload, customPayload, { source });
      L.PM.Utils._fireEvent(fireLayer, type, payload);
    }
  };
  var Events_default = EventMixin;

  // src/js/Mixins/Keyboard.ts
  var createKeyboardMixins = () => ({
    _lastEvents: { keydown: void 0, keyup: void 0, current: void 0 },
    _initKeyListener(map) {
      this.map = map;
      L.DomEvent.on(document, "keydown keyup", this._onKeyListener, this);
      L.DomEvent.on(window, "blur", this._onBlur, this);
      map.once("unload", this._unbindKeyListenerEvents, this);
    },
    _handleEscapeKey(e) {
      const pm = this.map.pm;
      const globalOptions = pm.getGlobalOptions();
      if (!globalOptions.exitModeOnEscape) {
        return false;
      }
      const hasActiveMode = pm.globalDrawModeEnabled() || pm.globalEditModeEnabled() || pm.globalDragModeEnabled() || pm.globalRemovalModeEnabled() || pm.globalRotateModeEnabled() || pm.globalCutModeEnabled();
      if (!hasActiveMode) {
        return false;
      }
      e.preventDefault();
      if (pm.globalDrawModeEnabled()) {
        pm.disableDraw();
      }
      if (pm.globalEditModeEnabled()) {
        pm.disableGlobalEditMode();
      }
      if (pm.globalDragModeEnabled()) {
        pm.disableGlobalDragMode();
      }
      if (pm.globalRemovalModeEnabled()) {
        pm.disableGlobalRemovalMode();
      }
      if (pm.globalRotateModeEnabled()) {
        pm.disableGlobalRotateMode();
      }
      if (pm.globalCutModeEnabled()) {
        pm.disableGlobalCutMode();
      }
      return true;
    },
    _handleEnterKey(e) {
      const pm = this.map.pm;
      const globalOptions = pm.getGlobalOptions();
      if (!globalOptions.finishOnEnter) {
        return false;
      }
      const activeShape = pm.Draw.getActiveShape();
      if (!activeShape) {
        return false;
      }
      const drawInstance = pm.Draw[activeShape];
      if (!drawInstance || !drawInstance._finishShape) {
        return false;
      }
      const canFinish = this._canFinishShape(drawInstance, activeShape);
      if (!canFinish) {
        return false;
      }
      e.preventDefault();
      drawInstance._finishShape();
      return true;
    },
    _canFinishShape(drawInstance, activeShape) {
      if (["Marker", "CircleMarker", "Text"].includes(activeShape)) {
        return false;
      }
      if (activeShape === "Rectangle") {
        return drawInstance._startMarker !== void 0;
      }
      if (activeShape === "Circle") {
        return drawInstance._centerMarker && drawInstance._layerGroup?.hasLayer(drawInstance._centerMarker);
      }
      if (drawInstance._layer && drawInstance._layer.getLatLngs) {
        const coords = drawInstance._layer.getLatLngs();
        if (activeShape === "Line") {
          const flatCoords = coords.flat ? coords.flat() : coords;
          return flatCoords.length >= 2;
        }
        if (activeShape === "Polygon" || activeShape === "Cut") {
          return coords.length >= 3;
        }
      }
      return false;
    },
    _unbindKeyListenerEvents() {
      L.DomEvent.off(document, "keydown keyup", this._onKeyListener, this);
      L.DomEvent.off(window, "blur", this._onBlur, this);
    },
    _onKeyListener(e) {
      let focusOn = "document";
      if (this.map.getContainer().contains(e.target)) {
        focusOn = "map";
      }
      const data = { event: e, eventType: e.type, focusOn };
      this._lastEvents[e.type] = data;
      this._lastEvents.current = data;
      this.map.pm._fireKeyeventEvent(e, e.type, focusOn);
      if (e.type === "keydown") {
        if (e.key === "Escape") {
          this._handleEscapeKey(e);
        }
        if (e.key === "Enter") {
          this._handleEnterKey(e);
        }
      }
    },
    _onBlur(e) {
      e.altKey = false;
      const data = {
        event: e,
        eventType: e.type,
        focusOn: "document"
      };
      this._lastEvents[e.type] = data;
      this._lastEvents.current = data;
    },
    getLastKeyEvent(type = "current") {
      return this._lastEvents[type];
    },
    isShiftKeyPressed() {
      return this._lastEvents.current?.event.shiftKey;
    },
    isAltKeyPressed() {
      return this._lastEvents.current?.event.altKey;
    },
    isCtrlKeyPressed() {
      return this._lastEvents.current?.event.ctrlKey;
    },
    isMetaKeyPressed() {
      return this._lastEvents.current?.event.metaKey;
    },
    getPressedKey() {
      return this._lastEvents.current?.event.key;
    }
  });
  var Keyboard_default = createKeyboardMixins;

  // src/js/helpers/index.ts
  var import_get = __toESM(require_get());
  function getTranslation(path) {
    const lang = L.PM.activeLang;
    return (0, import_get.default)(translations_default[lang], path) || (0, import_get.default)(translations_default.en, path) || path;
  }
  function hasFinePointer() {
    if (!window.matchMedia) {
      return true;
    }
    const hasCoarse = window.matchMedia("(pointer: coarse)").matches;
    if (hasCoarse) {
      return false;
    }
    return true;
  }
  function hasValues(list) {
    for (let i = 0; i < list.length; i += 1) {
      const item = list[i];
      if (Array.isArray(item)) {
        if (hasValues(item)) {
          return true;
        }
      } else if (item !== null && item !== void 0 && item !== "") {
        return true;
      }
    }
    return false;
  }
  function removeEmptyCoordRings(arr) {
    return arr.reduce((result, item) => {
      if (item.length !== 0) {
        const newItem = Array.isArray(item) ? removeEmptyCoordRings(item) : item;
        if (Array.isArray(newItem)) {
          if (newItem.length !== 0) {
            result.push(newItem);
          }
        } else {
          result.push(newItem);
        }
      }
      return result;
    }, []);
  }
  function destinationVincenty(lonlat, brng, dist) {
    const VincentyConstants = {
      a: L.CRS.Earth.R,
      b: 63567523142e-4,
      f: 1 / 298.257223563
    };
    const { a, b, f } = VincentyConstants;
    const lon1 = lonlat.lng;
    const lat1 = lonlat.lat;
    const s = dist;
    const pi = Math.PI;
    const alpha1 = brng * pi / 180;
    const sinAlpha1 = Math.sin(alpha1);
    const cosAlpha1 = Math.cos(alpha1);
    const tanU1 = (1 - f) * Math.tan(
      lat1 * pi / 180
      /* converts lat1 degrees to radius */
    );
    const cosU1 = 1 / Math.sqrt(1 + tanU1 * tanU1);
    const sinU1 = tanU1 * cosU1;
    const sigma1 = Math.atan2(tanU1, cosAlpha1);
    const sinAlpha = cosU1 * sinAlpha1;
    const cosSqAlpha = 1 - sinAlpha * sinAlpha;
    const uSq = cosSqAlpha * (a * a - b * b) / (b * b);
    const A = 1 + uSq / 16384 * (4096 + uSq * (-768 + uSq * (320 - 175 * uSq)));
    const B3 = uSq / 1024 * (256 + uSq * (-128 + uSq * (74 - 47 * uSq)));
    let sigma = s / (b * A);
    let sigmaP = 2 * Math.PI;
    let cos2SigmaM;
    let sinSigma;
    let cosSigma;
    while (Math.abs(sigma - sigmaP) > 1e-12) {
      cos2SigmaM = Math.cos(2 * sigma1 + sigma);
      sinSigma = Math.sin(sigma);
      cosSigma = Math.cos(sigma);
      const deltaSigma = B3 * sinSigma * (cos2SigmaM + B3 / 4 * (cosSigma * (-1 + 2 * cos2SigmaM * cos2SigmaM) - B3 / 6 * cos2SigmaM * (-3 + 4 * sinSigma * sinSigma) * (-3 + 4 * cos2SigmaM * cos2SigmaM)));
      sigmaP = sigma;
      sigma = s / (b * A) + deltaSigma;
    }
    const tmp = sinU1 * sinSigma - cosU1 * cosSigma * cosAlpha1;
    const lat2 = Math.atan2(
      sinU1 * cosSigma + cosU1 * sinSigma * cosAlpha1,
      (1 - f) * Math.sqrt(sinAlpha * sinAlpha + tmp * tmp)
    );
    const lambda = Math.atan2(
      sinSigma * sinAlpha1,
      cosU1 * cosSigma - sinU1 * sinSigma * cosAlpha1
    );
    const C = f / 16 * cosSqAlpha * (4 + f * (4 - 3 * cosSqAlpha));
    const lam = lambda - (1 - C) * f * sinAlpha * (sigma + C * sinSigma * (cos2SigmaM + C * cosSigma * (-1 + 2 * cos2SigmaM * cos2SigmaM)));
    const lamFunc = lon1 + lam * 180 / pi;
    const lat2a = lat2 * 180 / pi;
    return L.latLng(lamFunc, lat2a);
  }
  function createGeodesicPolygon(origin, radius, sides, rotation, withBearing = true) {
    let trueAngle;
    let newLonlat;
    let geomPoint;
    const points = [];
    for (let i = 0; i < sides; i += 1) {
      if (withBearing) {
        trueAngle = i * 360 / sides + rotation;
        newLonlat = destinationVincenty(origin, trueAngle, radius);
        geomPoint = L.latLng(newLonlat.lng, newLonlat.lat);
      } else {
        const pLat = origin.lat + Math.cos(2 * i * Math.PI / sides) * radius;
        const pLng = origin.lng + Math.sin(2 * i * Math.PI / sides) * radius;
        geomPoint = L.latLng(pLat, pLng);
      }
      points.push(geomPoint);
    }
    return points;
  }
  function destination(latlng, heading, distance2) {
    heading = (heading + 360) % 360;
    const rad = Math.PI / 180;
    const radInv = 180 / Math.PI;
    const { R } = L.CRS.Earth;
    const lon1 = latlng.lng * rad;
    const lat1 = latlng.lat * rad;
    const rheading = heading * rad;
    const sinLat1 = Math.sin(lat1);
    const cosLat1 = Math.cos(lat1);
    const cosDistR = Math.cos(distance2 / R);
    const sinDistR = Math.sin(distance2 / R);
    const lat2 = Math.asin(
      sinLat1 * cosDistR + cosLat1 * sinDistR * Math.cos(rheading)
    );
    let lon2 = lon1 + Math.atan2(
      Math.sin(rheading) * sinDistR * cosLat1,
      cosDistR - sinLat1 * Math.sin(lat2)
    );
    lon2 *= radInv;
    const optA = lon2 - 360;
    const optB = lon2 < -180 ? lon2 + 360 : lon2;
    lon2 = lon2 > 180 ? optA : optB;
    return L.latLng([lat2 * radInv, lon2]);
  }
  function calcAngle(map, latlngA, latlngB) {
    const pointA = map.latLngToContainerPoint(latlngA);
    const pointB = map.latLngToContainerPoint(latlngB);
    let angleDeg = Math.atan2(pointB.y - pointA.y, pointB.x - pointA.x) * 180 / Math.PI + 90;
    angleDeg += angleDeg < 0 ? 360 : 0;
    return angleDeg;
  }
  function destinationOnLine(map, latlngA, latlngB, distance2) {
    const angleDeg = calcAngle(map, latlngA, latlngB);
    return destination(latlngA, angleDeg, distance2);
  }
  function prioritiseSort(key, _sortingOrder, order = "asc") {
    if (!_sortingOrder || Object.keys(_sortingOrder).length === 0) {
      return (a, b) => a - b;
    }
    const keys = Object.keys(_sortingOrder);
    let objKey;
    let n = keys.length - 1;
    const sortingOrder = {};
    while (n >= 0) {
      objKey = keys[n];
      sortingOrder[objKey.toLowerCase()] = _sortingOrder[objKey];
      n -= 1;
    }
    function getShape(layer) {
      if (layer instanceof L.Marker) {
        return "Marker";
      }
      if (layer instanceof L.Circle) {
        return "Circle";
      }
      if (layer instanceof L.CircleMarker) {
        return "CircleMarker";
      }
      if (layer instanceof L.Rectangle) {
        return "Rectangle";
      }
      if (layer instanceof L.Polygon) {
        return "Polygon";
      }
      if (layer instanceof L.Polyline) {
        return "Line";
      }
      return void 0;
    }
    return (a, b) => {
      let keyA;
      let keyB;
      if (key === "instanceofShape") {
        keyA = getShape(a.layer).toLowerCase();
        keyB = getShape(b.layer).toLowerCase();
        if (!keyA || !keyB) return 0;
      } else {
        if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key))
          return 0;
        keyA = a[key].toLowerCase();
        keyB = b[key].toLowerCase();
      }
      const first = keyA in sortingOrder ? sortingOrder[keyA] : Number.MAX_SAFE_INTEGER;
      const second = keyB in sortingOrder ? sortingOrder[keyB] : Number.MAX_SAFE_INTEGER;
      let result = 0;
      if (first < second) result = -1;
      else if (first > second) result = 1;
      return order === "desc" ? result * -1 : result;
    };
  }
  function copyLatLngs(layer, latlngs = layer.getLatLngs()) {
    if (layer instanceof L.Polygon) {
      return L.polygon(latlngs).getLatLngs();
    }
    return L.polyline(latlngs).getLatLngs();
  }
  function fixLatOffset(latlng, map) {
    if (map.options.crs?.projection?.MAX_LATITUDE) {
      const max = map.options.crs?.projection?.MAX_LATITUDE;
      latlng.lat = Math.max(Math.min(max, latlng.lat), -max);
    }
    return latlng;
  }
  function getRenderer(layer) {
    return layer.options.renderer || layer._map && (layer._map._getPaneRenderer(
      layer.options.pane
    ) || layer._map.options.renderer || layer._map._renderer) || layer._renderer;
  }

  // src/js/helpers/language.ts
  function resolveLanguageCode(lang, availableTranslations) {
    lang = lang.trim().toLowerCase();
    if (availableTranslations[lang]) {
      return lang;
    }
    const normalizedLang = lang.replace(/[-_\s]/g, "_");
    const match = normalizedLang.match(/^([a-z]{2,3})(?:_([a-z]{2,3}))?$/);
    if (match) {
      const potentialKeys = [];
      if (match[2]) {
        potentialKeys.push(`${match[1]}_${match[2]}`);
      }
      potentialKeys.push(match[1]);
      for (const key of potentialKeys) {
        if (availableTranslations[key]) {
          return key;
        }
      }
    }
    return lang;
  }

  // src/js/L.PM.Map.ts
  var Map2 = L.Class.extend({
    includes: [
      Mode_Edit_default,
      Mode_Drag_default,
      Mode_Removal_default,
      Mode_Rotate_default,
      Events_default
    ],
    initialize(map) {
      this.map = map;
      this.Draw = new L.PM.Draw(map);
      this.Toolbar = new L.PM.Toolbar(map);
      this.Keyboard = Keyboard_default();
      this.globalOptions = {
        snappable: true,
        layerGroup: void 0,
        snappingOrder: [
          "Marker",
          "CircleMarker",
          "Circle",
          "Line",
          "Polygon",
          "Rectangle"
        ],
        panes: {
          vertexPane: "markerPane",
          layerPane: "overlayPane",
          markerPane: "markerPane"
        },
        draggable: true,
        exitModeOnEscape: false,
        finishOnEnter: false
      };
      this.Keyboard._initKeyListener(map);
    },
    setLang(lang = "en", override, fallback = "en") {
      lang = resolveLanguageCode(lang, translations_default);
      const oldLang = L.PM.activeLang;
      if (override) {
        translations_default[lang] = (0, import_merge2.default)(translations_default[fallback], override);
      }
      L.PM.activeLang = lang;
      this.map.pm.Toolbar.reinit();
      this._fireLangChange(oldLang, lang, fallback, translations_default[lang]);
    },
    addControls(options) {
      this.Toolbar.addControls(options);
    },
    removeControls() {
      this.Toolbar.removeControls();
    },
    toggleControls() {
      this.Toolbar.toggleControls();
    },
    controlsVisible() {
      return this.Toolbar.isVisible;
    },
    enableDraw(shape = "Polygon", options) {
      if (shape === "Poly") {
        shape = "Polygon";
      }
      this.Draw.enable(shape, options);
    },
    disableDraw(shape = "Polygon") {
      if (shape === "Poly") {
        shape = "Polygon";
      }
      this.Draw.disable(shape);
    },
    // optionsModifier for special options like ignoreShapes or merge
    setPathOptions(options, optionsModifier = {}) {
      const ignore = optionsModifier.ignoreShapes || [];
      const mergeOptions = optionsModifier.merge || false;
      this.map.pm.Draw.shapes.forEach((shape) => {
        if (ignore.indexOf(shape) === -1) {
          this.map.pm.Draw[shape].setPathOptions(
            options,
            mergeOptions
          );
        }
      });
    },
    getGlobalOptions() {
      return this.globalOptions;
    },
    setGlobalOptions(o) {
      const options = (0, import_merge2.default)(this.globalOptions, o);
      if (options.editable) {
        options.resizeableCircleMarker = options.editable;
        delete options.editable;
      }
      let reenableCircleMarker = false;
      if (this.map.pm.Draw.CircleMarker.enabled() && !!this.map.pm.Draw.CircleMarker.options.resizeableCircleMarker !== !!options.resizeableCircleMarker) {
        this.map.pm.Draw.CircleMarker.disable();
        reenableCircleMarker = true;
      }
      let reenableCircle = false;
      if (this.map.pm.Draw.Circle.enabled() && !!this.map.pm.Draw.Circle.options.resizeableCircle !== !!options.resizeableCircle) {
        this.map.pm.Draw.Circle.disable();
        reenableCircle = true;
      }
      this.map.pm.Draw.shapes.forEach((shape) => {
        this.map.pm.Draw[shape].setOptions(options);
      });
      if (reenableCircleMarker) {
        this.map.pm.Draw.CircleMarker.enable();
      }
      if (reenableCircle) {
        this.map.pm.Draw.Circle.enable();
      }
      const layers = L.PM.Utils.findLayers(this.map);
      layers.forEach((layer) => {
        layer.pm.setOptions(options);
      });
      this.map.fire("pm:globaloptionschanged");
      this.globalOptions = options;
      this.applyGlobalOptions();
    },
    applyGlobalOptions() {
      const layers = L.PM.Utils.findLayers(this.map);
      layers.forEach((layer) => {
        if (layer.pm.enabled()) {
          layer.pm.applyOptions();
        }
      });
    },
    globalDrawModeEnabled() {
      return !!this.Draw.getActiveShape();
    },
    globalCutModeEnabled() {
      return !!this.Draw.Cut.enabled();
    },
    enableGlobalCutMode(options) {
      return this.Draw.Cut.enable(options);
    },
    toggleGlobalCutMode(options) {
      return this.Draw.Cut.toggle(options);
    },
    disableGlobalCutMode() {
      return this.Draw.Cut.disable();
    },
    getGeomanLayers(asGroup = false) {
      const layers = L.PM.Utils.findLayers(this.map);
      if (!asGroup) {
        return layers;
      }
      const group = L.featureGroup();
      group._pmTempLayer = true;
      layers.forEach((layer) => {
        group.addLayer(layer);
      });
      return group;
    },
    getGeomanDrawLayers(asGroup = false) {
      const layers = L.PM.Utils.findLayers(this.map).filter(
        (l) => l._drawnByGeoman === true
      );
      if (!asGroup) {
        return layers;
      }
      const group = L.featureGroup();
      group._pmTempLayer = true;
      layers.forEach((layer) => {
        group.addLayer(layer);
      });
      return group;
    },
    // returns the map instance by default or a layergroup is set through global options
    _getContainingLayer() {
      return this.globalOptions.layerGroup && this.globalOptions.layerGroup instanceof L.LayerGroup ? this.globalOptions.layerGroup : this.map;
    },
    _isCRSSimple() {
      return this.map.options.crs === L.CRS.Simple;
    },
    // in Canvas mode we need to convert touch- and pointerevents (IE) to mouseevents, because Leaflet don't support them.
    _touchEventCounter: 0,
    _addTouchEvents(elm) {
      if (this._touchEventCounter === 0) {
        L.DomEvent.on(elm, "touchmove", this._canvasTouchMove, this);
        L.DomEvent.on(
          elm,
          "touchstart touchend touchcancel",
          this._canvasTouchClick,
          this
        );
      }
      this._touchEventCounter += 1;
    },
    _removeTouchEvents(elm) {
      if (this._touchEventCounter === 1) {
        L.DomEvent.off(elm, "touchmove", this._canvasTouchMove, this);
        L.DomEvent.off(
          elm,
          "touchstart touchend touchcancel",
          this._canvasTouchClick,
          this
        );
      }
      this._touchEventCounter = this._touchEventCounter <= 1 ? 0 : this._touchEventCounter - 1;
    },
    _canvasTouchMove(e) {
      getRenderer(this.map)._onMouseMove(
        this._createMouseEvent("mousemove", e)
      );
    },
    _canvasTouchClick(e) {
      let type = "";
      if (e.type === "touchstart" || e.type === "pointerdown") {
        type = "mousedown";
      } else if (e.type === "touchend" || e.type === "pointerup") {
        type = "mouseup";
      } else if (e.type === "touchcancel" || e.type === "pointercancel") {
        type = "mouseup";
      }
      if (!type) {
        return;
      }
      getRenderer(this.map)._onClick(
        this._createMouseEvent(type, e)
      );
    },
    _createMouseEvent(type, e) {
      let mouseEvent;
      const touchEvt = e.touches[0] || e.changedTouches[0];
      try {
        mouseEvent = new MouseEvent(type, {
          bubbles: e.bubbles,
          cancelable: e.cancelable,
          view: e.view,
          detail: touchEvt.detail,
          screenX: touchEvt.screenX,
          screenY: touchEvt.screenY,
          clientX: touchEvt.clientX,
          clientY: touchEvt.clientY,
          ctrlKey: e.ctrlKey,
          altKey: e.altKey,
          shiftKey: e.shiftKey,
          metaKey: e.metaKey,
          button: e.button,
          relatedTarget: e.relatedTarget
        });
      } catch (ex) {
        mouseEvent = document.createEvent("MouseEvents");
        mouseEvent.initMouseEvent(
          type,
          e.bubbles,
          e.cancelable,
          e.view,
          touchEvt.detail,
          touchEvt.screenX,
          touchEvt.screenY,
          touchEvt.clientX,
          touchEvt.clientY,
          e.ctrlKey,
          e.altKey,
          e.shiftKey,
          e.metaKey,
          e.button,
          e.relatedTarget
        );
      }
      return mouseEvent;
    }
  });
  var L_PM_Map_default = Map2;

  // src/js/Toolbar/L.Controls.ts
  var PMButton = L.Control.extend({
    includes: [Events_default],
    options: {
      position: "topleft",
      disableByOtherButtons: true
    },
    // TODO: clean up variable names like _button should be _options and that domNodeVariable stuff
    initialize(options) {
      this._button = L.Util.extend({}, this.options, options);
    },
    onAdd(map) {
      this._map = map;
      if (!this._map.pm.Toolbar.options.oneBlock) {
        if (this._button.tool === "edit") {
          this._container = this._map.pm.Toolbar.editContainer;
        } else if (this._button.tool === "options") {
          this._container = this._map.pm.Toolbar.optionsContainer;
        } else if (this._button.tool === "custom") {
          this._container = this._map.pm.Toolbar.customContainer;
        } else {
          this._container = this._map.pm.Toolbar.drawContainer;
        }
      } else {
        this._container = this._map.pm.Toolbar._createContainer(
          this.options.position
        );
      }
      this._renderButton();
      return this._container;
    },
    _renderButton() {
      const oldDomNode = this.buttonsDomNode;
      this.buttonsDomNode = this._makeButton(this._button);
      if (oldDomNode) {
        oldDomNode.replaceWith(this.buttonsDomNode);
      } else {
        this._container.appendChild(this.buttonsDomNode);
      }
    },
    onRemove() {
      this.buttonsDomNode.remove();
      return this._container;
    },
    getText() {
      return this._button.text;
    },
    getIconUrl() {
      return this._button.iconUrl;
    },
    destroy() {
      this._button = {};
      this.buttonsDomNode?.remove();
    },
    toggle(e) {
      if (typeof e === "boolean") {
        this._button.toggleStatus = e;
      } else {
        this._button.toggleStatus = !this._button.toggleStatus;
      }
      this._applyStyleClasses();
      this._updateActiveAction(this._button);
      return this._button.toggleStatus;
    },
    toggled() {
      return this._button.toggleStatus;
    },
    onCreate() {
      this.toggle(false);
    },
    disable() {
      this.toggle(false);
      this._button.disabled = true;
      this._updateDisabled();
    },
    enable() {
      this._button.disabled = false;
      this._updateDisabled();
      this._updateActiveAction(this._button);
    },
    _triggerClick(e) {
      if (e) {
        e.preventDefault();
      }
      if (this._button.disabled) {
        return;
      }
      this._button.onClick(e, { button: this, event: e });
      this._clicked(e);
      this._button.afterClick(e, { button: this, event: e });
    },
    _makeButton(button) {
      const pos = this.options.position.indexOf("right") > -1 ? "pos-right" : "";
      const buttonContainer = L.DomUtil.create(
        "div",
        `button-container  ${pos}`,
        this._container
      );
      if (button.title) {
        buttonContainer.setAttribute("title", button.title);
      }
      const newButton = L.DomUtil.create(
        "a",
        "leaflet-buttons-control-button",
        buttonContainer
      );
      newButton.setAttribute("role", "button");
      newButton.setAttribute("tabindex", "0");
      newButton.href = "#";
      const actionContainer = L.DomUtil.create(
        "div",
        `leaflet-pm-actions-container ${pos}`,
        buttonContainer
      );
      const activeActions = button.actions;
      const actions = {
        cancel: {
          text: getTranslation("actions.cancel"),
          title: getTranslation("actions.cancel"),
          onClick() {
            this._triggerClick();
          }
        },
        finishMode: {
          text: getTranslation("actions.finish"),
          title: getTranslation("actions.finish"),
          onClick() {
            this._triggerClick();
          }
        },
        removeLastVertex: {
          text: getTranslation("actions.removeLastVertex"),
          title: getTranslation("actions.removeLastVertex"),
          onClick() {
            this._map.pm.Draw[button.jsClass]._removeLastVertex();
          }
        },
        finish: {
          text: getTranslation("actions.finish"),
          title: getTranslation("actions.finish"),
          onClick(e) {
            this._map.pm.Draw[button.jsClass]._finishShape(e);
          }
        }
      };
      button._preparedActions = activeActions.map((_action) => {
        const name = typeof _action === "string" ? _action : _action.name;
        let action;
        if (actions[name]) {
          action = actions[name];
        } else if (_action.text) {
          action = _action;
        } else {
          return action;
        }
        const actionNode = L.DomUtil.create(
          "a",
          `leaflet-pm-action ${pos} action-${name}`,
          actionContainer
        );
        actionNode.setAttribute("role", "button");
        actionNode.setAttribute("tabindex", "0");
        actionNode.href = "#";
        if (action.title) {
          actionNode.title = action.title;
        }
        actionNode.innerHTML = action.text;
        L.DomEvent.disableClickPropagation(actionNode);
        L.DomEvent.on(actionNode, "click", L.DomEvent.stop);
        action._node = actionNode;
        if (!button.disabled) {
          if (action.onClick) {
            const actionClick = (e) => {
              e.preventDefault();
              let btnName = "";
              const { buttons } = this._map.pm.Toolbar;
              for (const btn in buttons) {
                if (buttons[btn]._button === button) {
                  btnName = btn;
                  break;
                }
              }
              this._fireActionClick(action, btnName, button);
            };
            L.DomEvent.addListener(actionNode, "click", actionClick, this);
            L.DomEvent.addListener(actionNode, "click", action.onClick, this);
            L.DomEvent.addListener(
              actionNode,
              "click",
              () => this._updateActiveAction(button)
            );
          }
        }
        return action;
      });
      this._updateActiveAction(button);
      if (button.toggleStatus) {
        L.DomUtil.addClass(buttonContainer, "active");
      }
      const image = L.DomUtil.create("div", "control-icon", newButton);
      if (button.iconUrl) {
        image.setAttribute("src", button.iconUrl);
      }
      if (button.className) {
        L.DomUtil.addClass(image, button.className);
      }
      L.DomEvent.disableClickPropagation(newButton);
      L.DomEvent.on(newButton, "click", L.DomEvent.stop);
      if (!button.disabled) {
        L.DomEvent.addListener(newButton, "click", this._onBtnClick, this);
        L.DomEvent.addListener(newButton, "click", this._triggerClick, this);
      }
      if (button.disabled) {
        L.DomUtil.addClass(newButton, "pm-disabled");
        newButton.setAttribute("aria-disabled", "true");
      }
      return buttonContainer;
    },
    _applyStyleClasses() {
      if (!this._container) {
        return;
      }
      if (!this._button.toggleStatus || this._button.cssToggle === false) {
        L.DomUtil.removeClass(this.buttonsDomNode, "active");
        L.DomUtil.removeClass(this._container, "activeChild");
      } else {
        L.DomUtil.addClass(this.buttonsDomNode, "active");
        L.DomUtil.addClass(this._container, "activeChild");
      }
    },
    _onBtnClick() {
      if (this._button.disabled) {
        return;
      }
      if (this._button.disableOtherButtons) {
        this._map.pm.Toolbar.triggerClickOnToggledButtons(this);
      }
      let btnName = "";
      const { buttons } = this._map.pm.Toolbar;
      for (const btn in buttons) {
        if (buttons[btn]._button === this._button) {
          btnName = btn;
          break;
        }
      }
      this._fireButtonClick(btnName, this._button);
    },
    _clicked() {
      if (this._button.doToggle) {
        this.toggle();
      }
    },
    _updateDisabled() {
      if (!this._container) {
        return;
      }
      const className = "pm-disabled";
      const button = this.buttonsDomNode.children[0];
      if (this._button.disabled) {
        L.DomUtil.addClass(button, className);
        button.setAttribute("aria-disabled", "true");
      } else {
        L.DomUtil.removeClass(button, className);
        button.setAttribute("aria-disabled", "false");
      }
    },
    _updateActiveAction(button) {
      button._preparedActions?.forEach((action) => {
        if (action?._node) {
          if (action.isActive && action.isActive.call(this)) {
            L.DomUtil.addClass(action._node, "active-action");
          } else {
            L.DomUtil.removeClass(action._node, "active-action");
          }
        }
      });
    }
  });
  var L_Controls_default = PMButton;

  // src/js/Toolbar/L.PM.Toolbar.ts
  L.Control.PMButton = L_Controls_default;
  var Toolbar = L.Class.extend({
    options: {
      drawMarker: true,
      drawRectangle: true,
      drawPolyline: true,
      drawPolygon: true,
      drawCircle: true,
      drawCircleMarker: true,
      drawText: true,
      editMode: true,
      dragMode: true,
      cutPolygon: true,
      removalMode: true,
      rotateMode: true,
      snappingOption: true,
      drawControls: true,
      editControls: true,
      optionsControls: true,
      customControls: true,
      oneBlock: false,
      position: "topleft",
      positions: {
        draw: "",
        edit: "",
        options: "",
        custom: ""
      }
    },
    customButtons: [],
    initialize(map) {
      this.customButtons = [];
      this.options.positions = {
        draw: "",
        edit: "",
        options: "",
        custom: ""
      };
      this.init(map);
    },
    reinit() {
      const addControls = this.isVisible;
      this.removeControls();
      this._defineButtons();
      if (addControls) {
        this.addControls();
      }
    },
    init(map) {
      this.map = map;
      this.buttons = {};
      this.isVisible = false;
      this.drawContainer = L.DomUtil.create(
        "div",
        "leaflet-pm-toolbar leaflet-pm-draw leaflet-bar leaflet-control"
      );
      this.editContainer = L.DomUtil.create(
        "div",
        "leaflet-pm-toolbar leaflet-pm-edit leaflet-bar leaflet-control"
      );
      this.optionsContainer = L.DomUtil.create(
        "div",
        "leaflet-pm-toolbar leaflet-pm-options leaflet-bar leaflet-control"
      );
      this.customContainer = L.DomUtil.create(
        "div",
        "leaflet-pm-toolbar leaflet-pm-custom leaflet-bar leaflet-control"
      );
      this._defineButtons();
    },
    _createContainer(name) {
      const container = `${name}Container`;
      if (!this[container]) {
        this[container] = L.DomUtil.create(
          "div",
          `leaflet-pm-toolbar leaflet-pm-${name} leaflet-bar leaflet-control`
        );
      }
      return this[container];
    },
    getButtons() {
      return this.buttons;
    },
    addControls(options = this.options) {
      if (typeof options.editPolygon !== "undefined") {
        options.editMode = options.editPolygon;
      }
      if (typeof options.deleteLayer !== "undefined") {
        options.removalMode = options.deleteLayer;
      }
      L.Util.setOptions(this, options);
      this.applyIconStyle();
      this.isVisible = true;
      this._showHideButtons();
    },
    applyIconStyle() {
      const buttons = this.getButtons();
      const iconClasses = {
        geomanIcons: {
          drawMarker: "control-icon leaflet-pm-icon-marker",
          drawPolyline: "control-icon leaflet-pm-icon-polyline",
          drawRectangle: "control-icon leaflet-pm-icon-rectangle",
          drawPolygon: "control-icon leaflet-pm-icon-polygon",
          drawCircle: "control-icon leaflet-pm-icon-circle",
          drawCircleMarker: "control-icon leaflet-pm-icon-circle-marker",
          editMode: "control-icon leaflet-pm-icon-edit",
          dragMode: "control-icon leaflet-pm-icon-drag",
          cutPolygon: "control-icon leaflet-pm-icon-cut",
          removalMode: "control-icon leaflet-pm-icon-delete",
          drawText: "control-icon leaflet-pm-icon-text"
        }
      };
      for (const name in buttons) {
        const button = buttons[name];
        L.Util.setOptions(button, {
          className: iconClasses.geomanIcons[name]
        });
      }
    },
    removeControls() {
      const buttons = this.getButtons();
      for (const btn in buttons) {
        buttons[btn].remove();
      }
      this.isVisible = false;
    },
    deleteControl(name) {
      const btnName = this._btnNameMapping(name);
      if (this.buttons[btnName]) {
        this.buttons[btnName].remove();
        delete this.buttons[btnName];
      }
    },
    toggleControls(options = this.options) {
      if (this.isVisible) {
        this.removeControls();
      } else {
        this.addControls(options);
      }
    },
    _addButton(name, button) {
      this.buttons[name] = button;
      this.options[name] = !!this.options[name] || false;
      return this.buttons[name];
    },
    triggerClickOnToggledButtons(exceptThisButton) {
      for (const name in this.buttons) {
        const button = this.buttons[name];
        if (button._button.disableByOtherButtons && button !== exceptThisButton && button.toggled()) {
          button._triggerClick();
        }
      }
    },
    toggleButton(name, status, disableOthers = true) {
      if (name === "editPolygon") {
        name = "editMode";
      }
      if (name === "deleteLayer") {
        name = "removalMode";
      }
      const toggleBtnName = name;
      if (disableOthers) {
        this.triggerClickOnToggledButtons(this.buttons[toggleBtnName]);
      }
      if (!this.buttons[toggleBtnName]) {
        return false;
      }
      return this.buttons[toggleBtnName].toggle(status);
    },
    _defineButtons() {
      const drawMarkerButton = {
        className: "control-icon leaflet-pm-icon-marker",
        title: getTranslation("buttonTitles.drawMarkerButton"),
        jsClass: "Marker",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["cancel"]
      };
      const drawPolyButton = {
        title: getTranslation("buttonTitles.drawPolyButton"),
        className: "control-icon leaflet-pm-icon-polygon",
        jsClass: "Polygon",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["finish", "removeLastVertex", "cancel"]
      };
      const drawLineButton = {
        className: "control-icon leaflet-pm-icon-polyline",
        title: getTranslation("buttonTitles.drawLineButton"),
        jsClass: "Line",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["finish", "removeLastVertex", "cancel"]
      };
      const drawCircleButton = {
        title: getTranslation("buttonTitles.drawCircleButton"),
        className: "control-icon leaflet-pm-icon-circle",
        jsClass: "Circle",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["cancel"]
      };
      const drawCircleMarkerButton = {
        title: getTranslation("buttonTitles.drawCircleMarkerButton"),
        className: "control-icon leaflet-pm-icon-circle-marker",
        jsClass: "CircleMarker",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["cancel"]
      };
      const drawRectButton = {
        title: getTranslation("buttonTitles.drawRectButton"),
        className: "control-icon leaflet-pm-icon-rectangle",
        jsClass: "Rectangle",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["cancel"]
      };
      const editButton = {
        title: getTranslation("buttonTitles.editButton"),
        className: "control-icon leaflet-pm-icon-edit",
        onClick: () => {
        },
        afterClick: () => {
          this.map.pm.toggleGlobalEditMode();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        tool: "edit",
        actions: ["finishMode"]
      };
      const dragButton = {
        title: getTranslation("buttonTitles.dragButton"),
        className: "control-icon leaflet-pm-icon-drag",
        onClick: () => {
        },
        afterClick: () => {
          this.map.pm.toggleGlobalDragMode();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        tool: "edit",
        actions: ["finishMode"]
      };
      const cutButton = {
        title: getTranslation("buttonTitles.cutButton"),
        className: "control-icon leaflet-pm-icon-cut",
        jsClass: "Cut",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle({
            snappable: true,
            cursorMarker: true,
            allowSelfIntersection: false
          });
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        tool: "edit",
        actions: ["finish", "removeLastVertex", "cancel"]
      };
      const deleteButton = {
        title: getTranslation("buttonTitles.deleteButton"),
        className: "control-icon leaflet-pm-icon-delete",
        onClick: () => {
        },
        afterClick: () => {
          this.map.pm.toggleGlobalRemovalMode();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        tool: "edit",
        actions: ["finishMode"]
      };
      const rotateButton = {
        title: getTranslation("buttonTitles.rotateButton"),
        className: "control-icon leaflet-pm-icon-rotate",
        onClick: () => {
        },
        afterClick: () => {
          this.map.pm.toggleGlobalRotateMode();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        tool: "edit",
        actions: ["finishMode"]
      };
      const drawTextButton = {
        className: "control-icon leaflet-pm-icon-text",
        title: getTranslation("buttonTitles.drawTextButton"),
        jsClass: "Text",
        onClick: () => {
        },
        afterClick: (e, ctx) => {
          this.map.pm.Draw[ctx.button._button.jsClass].toggle();
        },
        doToggle: true,
        toggleStatus: false,
        disableOtherButtons: true,
        position: this.options.position,
        actions: ["cancel"]
      };
      this._addButton("drawMarker", new L.Control.PMButton(drawMarkerButton));
      this._addButton("drawPolyline", new L.Control.PMButton(drawLineButton));
      this._addButton("drawRectangle", new L.Control.PMButton(drawRectButton));
      this._addButton("drawPolygon", new L.Control.PMButton(drawPolyButton));
      this._addButton("drawCircle", new L.Control.PMButton(drawCircleButton));
      this._addButton(
        "drawCircleMarker",
        new L.Control.PMButton(drawCircleMarkerButton)
      );
      this._addButton("drawText", new L.Control.PMButton(drawTextButton));
      this._addButton("editMode", new L.Control.PMButton(editButton));
      this._addButton("dragMode", new L.Control.PMButton(dragButton));
      this._addButton("cutPolygon", new L.Control.PMButton(cutButton));
      this._addButton("removalMode", new L.Control.PMButton(deleteButton));
      this._addButton("rotateMode", new L.Control.PMButton(rotateButton));
    },
    _showHideButtons() {
      if (!this.isVisible) {
        return;
      }
      this.removeControls();
      this.isVisible = true;
      const buttons = this.getButtons();
      let ignoreBtns = [];
      if (this.options.drawControls === false) {
        ignoreBtns = ignoreBtns.concat(
          Object.keys(buttons).filter((btn) => !buttons[btn]._button.tool)
        );
      }
      if (this.options.editControls === false) {
        ignoreBtns = ignoreBtns.concat(
          Object.keys(buttons).filter(
            (btn) => buttons[btn]._button.tool === "edit"
          )
        );
      }
      if (this.options.optionsControls === false) {
        ignoreBtns = ignoreBtns.concat(
          Object.keys(buttons).filter(
            (btn) => buttons[btn]._button.tool === "options"
          )
        );
      }
      if (this.options.customControls === false) {
        ignoreBtns = ignoreBtns.concat(
          Object.keys(buttons).filter(
            (btn) => buttons[btn]._button.tool === "custom"
          )
        );
      }
      for (const btn in buttons) {
        if (this.options[btn] && ignoreBtns.indexOf(btn) === -1) {
          let block = buttons[btn]._button.tool;
          if (!block) {
            block = "draw";
          }
          buttons[btn].setPosition(this._getBtnPosition(block));
          buttons[btn].addTo(this.map);
        }
      }
    },
    _getBtnPosition(block) {
      return this.options.positions && this.options.positions[block] ? this.options.positions[block] : this.options.position;
    },
    setBlockPosition(block, position) {
      this.options.positions[block] = position;
      this._showHideButtons();
      this.changeControlOrder();
    },
    getBlockPositions() {
      return this.options.positions;
    },
    copyDrawControl(copyInstance, options) {
      if (!options) {
        throw new TypeError("Button has no name");
      } else if (typeof options !== "object") {
        options = { name: options };
      }
      const instance = this._btnNameMapping(copyInstance);
      if (!options.name) {
        throw new TypeError("Button has no name");
      }
      if (this.buttons[options.name]) {
        throw new TypeError("Button with this name already exists");
      }
      const drawInstance = this.map.pm.Draw.createNewDrawInstance(
        options.name,
        instance
      );
      const btn = this.buttons[instance]._button;
      options = { ...btn, ...options };
      const control = this.createCustomControl(options);
      return { drawInstance, control };
    },
    createCustomControl(options) {
      if (!options.name) {
        throw new TypeError("Button has no name");
      }
      if (this.buttons[options.name]) {
        throw new TypeError("Button with this name already exists");
      }
      if (!options.onClick) {
        options.onClick = () => {
        };
      }
      if (!options.afterClick) {
        options.afterClick = () => {
        };
      }
      if (options.toggle !== false) {
        options.toggle = true;
      }
      if (options.block) {
        options.block = options.block.toLowerCase();
      }
      if (!options.block || options.block === "draw") {
        options.block = "";
      }
      if (!options.className) {
        options.className = "control-icon";
      } else if (options.className.indexOf("control-icon") === -1) {
        options.className = `control-icon ${options.className}`;
      }
      const _options = {
        tool: options.block,
        className: options.className,
        title: options.title || "",
        jsClass: options.name,
        onClick: options.onClick,
        afterClick: options.afterClick,
        doToggle: options.toggle,
        toggleStatus: false,
        disableOtherButtons: options.disableOtherButtons ?? true,
        disableByOtherButtons: options.disableByOtherButtons ?? true,
        cssToggle: options.toggle,
        position: this.options.position,
        actions: options.actions || [],
        disabled: !!options.disabled
      };
      if (this.options[options.name] !== false) {
        this.options[options.name] = true;
      }
      const control = this._addButton(
        options.name,
        new L.Control.PMButton(_options)
      );
      this.changeControlOrder();
      return control;
    },
    controlExists(name) {
      return Boolean(this.getButton(name));
    },
    getButton(name) {
      return this.getButtons()[name];
    },
    getButtonsInBlock(name) {
      const buttonsInBlock = {};
      if (name) {
        for (const buttonName in this.getButtons()) {
          const button = this.getButtons()[buttonName];
          if (button._button.tool === name || name === "draw" && !button._button.tool) {
            buttonsInBlock[buttonName] = button;
          }
        }
      }
      return buttonsInBlock;
    },
    changeControlOrder(order = []) {
      const shapeMapping = this._shapeMapping();
      const _order = [];
      order.forEach((shape) => {
        if (shapeMapping[shape]) {
          _order.push(shapeMapping[shape]);
        } else {
          _order.push(shape);
        }
      });
      const buttons = this.getButtons();
      const newbtnorder = {};
      _order.forEach((control) => {
        if (buttons[control]) {
          newbtnorder[control] = buttons[control];
        }
      });
      const drawBtns = Object.keys(buttons).filter(
        (btn) => !buttons[btn]._button.tool || buttons[btn]._button.tool === "draw"
      );
      drawBtns.forEach((btn) => {
        if (_order.indexOf(btn) === -1) {
          newbtnorder[btn] = buttons[btn];
        }
      });
      const editBtns = Object.keys(buttons).filter(
        (btn) => buttons[btn]._button.tool === "edit"
      );
      editBtns.forEach((btn) => {
        if (_order.indexOf(btn) === -1) {
          newbtnorder[btn] = buttons[btn];
        }
      });
      const optionsBtns = Object.keys(buttons).filter(
        (btn) => buttons[btn]._button.tool === "options"
      );
      optionsBtns.forEach((btn) => {
        if (_order.indexOf(btn) === -1) {
          newbtnorder[btn] = buttons[btn];
        }
      });
      const customBtns = Object.keys(buttons).filter(
        (btn) => buttons[btn]._button.tool === "custom"
      );
      customBtns.forEach((btn) => {
        if (_order.indexOf(btn) === -1) {
          newbtnorder[btn] = buttons[btn];
        }
      });
      Object.keys(buttons).forEach((btn) => {
        if (_order.indexOf(btn) === -1) {
          newbtnorder[btn] = buttons[btn];
        }
      });
      this.map.pm.Toolbar.buttons = newbtnorder;
      this._showHideButtons();
    },
    getControlOrder() {
      const buttons = this.getButtons();
      const order = [];
      for (const btn in buttons) {
        order.push(btn);
      }
      return order;
    },
    changeActionsOfControl(name, actions) {
      const btnName = this._btnNameMapping(name);
      if (!btnName) {
        throw new TypeError("No name passed");
      }
      if (!actions) {
        throw new TypeError("No actions passed");
      }
      if (!this.buttons[btnName]) {
        throw new TypeError("Button with this name not exists");
      }
      this.buttons[btnName]._button.actions = actions;
      this.changeControlOrder();
    },
    setButtonDisabled(name, state) {
      const btnName = this._btnNameMapping(name);
      if (state) {
        this.buttons[btnName].disable();
      } else {
        this.buttons[btnName].enable();
      }
    },
    _shapeMapping() {
      return {
        Marker: "drawMarker",
        Circle: "drawCircle",
        Polygon: "drawPolygon",
        Rectangle: "drawRectangle",
        Polyline: "drawPolyline",
        Line: "drawPolyline",
        CircleMarker: "drawCircleMarker",
        Edit: "editMode",
        Drag: "dragMode",
        Cut: "cutPolygon",
        Removal: "removalMode",
        Rotate: "rotateMode",
        Text: "drawText"
      };
    },
    _btnNameMapping(name) {
      const shapeMapping = this._shapeMapping();
      return shapeMapping[name] ? shapeMapping[name] : name;
    }
  });
  var L_PM_Toolbar_default = Toolbar;

  // src/js/Draw/L.PM.Draw.ts
  var import_merge3 = __toESM(require_merge());

  // src/js/Mixins/Snapping.ts
  var SnapMixin = {
    _initSnappableMarkers() {
      this.options.snapDistance = this.options.snapDistance || 30;
      this.options.snapSegment = this.options.snapSegment === void 0 ? true : this.options.snapSegment;
      this._assignEvents(this._markers);
      this._layer.off("pm:dragstart", this._unsnap, this);
      this._layer.on("pm:dragstart", this._unsnap, this);
    },
    _disableSnapping() {
      this._layer.off("pm:dragstart", this._unsnap, this);
    },
    _assignEvents(markerArr) {
      markerArr.forEach((marker) => {
        if (Array.isArray(marker)) {
          this._assignEvents(marker);
          return;
        }
        marker.off("drag", this._handleSnapping, this);
        marker.on("drag", this._handleSnapping, this);
        marker.off("dragend", this._cleanupSnapping, this);
        marker.on("dragend", this._cleanupSnapping, this);
      });
    },
    _cleanupSnapping(e) {
      if (e) {
        const marker = e.target;
        marker._snapped = false;
      }
      delete this._snapList;
      if (this.throttledList) {
        this._map.off("layeradd", this.throttledList, this);
        this.throttledList = void 0;
      }
      this._map.off("layerremove", this._handleSnapLayerRemoval, this);
      if (this.debugIndicatorLines) {
        this.debugIndicatorLines.forEach((line) => {
          line.remove();
        });
      }
    },
    _handleThrottleSnapping() {
      if (this.throttledList) {
        this._createSnapList();
      }
    },
    _handleSnapping(e, selfSnapOnly = false) {
      const marker = e.target;
      marker._snapped = false;
      if (!this.throttledList) {
        this.throttledList = L.Util.throttle(
          this._handleThrottleSnapping,
          100,
          this
        );
      }
      if (e?.originalEvent?.altKey || this._map?.pm?.Keyboard.isAltKeyPressed()) {
        return false;
      }
      let snapList;
      if (selfSnapOnly) {
        if (!this._otherSnapLayers || this._otherSnapLayers.length === 0) {
          return false;
        }
        snapList = this._otherSnapLayers;
      } else {
        if (this._snapList === void 0) {
          this._createSnapList();
          this._map.off("layeradd", this.throttledList, this);
          this._map.on("layeradd", this.throttledList, this);
        }
        snapList = this._snapList;
      }
      if (snapList.length <= 0) {
        return false;
      }
      const closestLayer = this._calcClosestLayer(marker.getLatLng(), snapList);
      if (Object.keys(closestLayer).length === 0) {
        return false;
      }
      const isMarker = closestLayer.layer instanceof L.Marker || closestLayer.layer instanceof L.CircleMarker || !this.options.snapSegment;
      let snapLatLng;
      if (!isMarker) {
        snapLatLng = this._checkPrioritiySnapping(closestLayer);
      } else {
        snapLatLng = closestLayer.latlng;
      }
      const minDistance = this.options.snapDistance;
      const eventInfo = {
        marker,
        shape: this._shape,
        snapLatLng,
        segment: closestLayer.segment,
        layer: this._layer,
        workingLayer: this._layer,
        layerInteractedWith: closestLayer.layer,
        // for lack of a better property name
        distance: closestLayer.distance
      };
      this._fireSnapDrag(eventInfo.marker, eventInfo);
      this._fireSnapDrag(this._layer, eventInfo);
      if (closestLayer.distance < minDistance) {
        marker._orgLatLng = marker.getLatLng();
        marker.setLatLng(snapLatLng);
        marker._snapped = true;
        marker._snapInfo = eventInfo;
        const triggerSnap = () => {
          this._snapLatLng = snapLatLng;
          this._fireSnap(marker, eventInfo);
          this._fireSnap(this._layer, eventInfo);
        };
        const a = this._snapLatLng || {};
        const b = snapLatLng || {};
        if (a.lat !== b.lat || a.lng !== b.lng) {
          triggerSnap();
        }
      } else if (this._snapLatLng) {
        this._unsnap(eventInfo);
        marker._snapped = false;
        marker._snapInfo = void 0;
        this._fireUnsnap(eventInfo.marker, eventInfo);
        this._fireUnsnap(this._layer, eventInfo);
      }
      return true;
    },
    _createSnapList() {
      let layers = [];
      const debugIndicatorLines = [];
      const map = this._map;
      map.off("layerremove", this._handleSnapLayerRemoval, this);
      map.on("layerremove", this._handleSnapLayerRemoval, this);
      map.eachLayer((layer) => {
        if ((layer instanceof L.Polyline || layer instanceof L.Marker || layer instanceof L.CircleMarker || layer instanceof L.ImageOverlay) && layer.options.snapIgnore !== true) {
          if (layer.options.snapIgnore === void 0 && (!L.PM.optIn && layer.options.pmIgnore === true || // if optIn is not set and pmIgnore is true, the layer will be ignored
          L.PM.optIn && layer.options.pmIgnore !== false)) {
            return;
          }
          if ((layer instanceof L.Circle || layer instanceof L.CircleMarker) && layer.pm && layer.pm._hiddenPolyCircle) {
            layers.push(layer.pm._hiddenPolyCircle);
          } else if (layer instanceof L.ImageOverlay) {
            layer = L.rectangle(layer.getBounds());
          }
          layers.push(layer);
          const debugLine = L.polyline([], { color: "red", pmIgnore: true });
          debugLine._pmTempLayer = true;
          debugIndicatorLines.push(debugLine);
          if (layer instanceof L.Circle || layer instanceof L.CircleMarker) {
            debugIndicatorLines.push(debugLine);
          }
        }
      });
      layers = layers.filter((layer) => this._layer !== layer);
      layers = layers.filter(
        (layer) => layer._latlng || layer._latlngs && hasValues(layer._latlngs)
      );
      layers = layers.filter((layer) => !layer._pmTempLayer);
      if (this._otherSnapLayers) {
        this._otherSnapLayers.forEach(() => {
          const debugLine = L.polyline([], { color: "red", pmIgnore: true });
          debugLine._pmTempLayer = true;
          debugIndicatorLines.push(debugLine);
        });
        this._snapList = layers.concat(this._otherSnapLayers);
      } else {
        this._snapList = layers;
      }
      this.debugIndicatorLines = debugIndicatorLines;
    },
    _handleSnapLayerRemoval({ layer }) {
      if (!layer._leaflet_id) {
        return;
      }
      const index = this._snapList.findIndex(
        (e) => e._leaflet_id === layer._leaflet_id
      );
      if (index > -1) {
        this._snapList.splice(index, 1);
      }
    },
    _calcClosestLayer(latlng, layers) {
      return this._calcClosestLayers(latlng, layers, 1)[0];
    },
    _calcClosestLayers(latlng, layers, amount = 1) {
      let closestLayers = [];
      let closestLayer = {};
      layers.forEach((layer, index) => {
        if (layer._parentCopy && layer._parentCopy === this._layer) {
          return;
        }
        if (layer.getLatLngs?.().flat(5).length < 2) {
          return;
        }
        const results = this._calcLayerDistances(latlng, layer);
        results.distance = Math.floor(results.distance);
        if (this.debugIndicatorLines) {
          if (!this.debugIndicatorLines[index]) {
            const debugLine = L.polyline([], { color: "red", pmIgnore: true });
            debugLine._pmTempLayer = true;
            this.debugIndicatorLines[index] = debugLine;
          }
          this.debugIndicatorLines[index].setLatLngs([latlng, results.latlng]);
        }
        if (amount === 1 && (closestLayer.distance === void 0 || results.distance - 5 <= closestLayer.distance)) {
          if (results.distance + 5 < closestLayer.distance) {
            closestLayers = [];
          }
          closestLayer = results;
          closestLayer.layer = layer;
          closestLayers.push(closestLayer);
        } else if (amount !== 1) {
          closestLayer = {};
          closestLayer = results;
          closestLayer.layer = layer;
          closestLayers.push(closestLayer);
        }
      });
      if (amount !== 1) {
        closestLayers = closestLayers.sort((a, b) => a.distance - b.distance);
      }
      if (amount === -1) {
        amount = closestLayers.length;
      }
      const result = this._getClosestLayerByPriority(closestLayers, amount);
      if (L.Util.isArray(result)) {
        return result;
      }
      return [result];
    },
    _calcLayerDistances(latlng, layer) {
      const map = this._map;
      const isMarker = layer instanceof L.Marker || layer instanceof L.CircleMarker;
      const isPolygon = layer instanceof L.Polygon;
      const P = latlng;
      if (isMarker) {
        const latlngs = layer.getLatLng();
        return {
          latlng: { ...latlngs },
          distance: this._getDistance(map, latlngs, P)
        };
      }
      return this._calcLatLngDistances(P, layer.getLatLngs(), map, isPolygon);
    },
    _calcLatLngDistances(latlng, latlngs, map, closedShape = false) {
      let closestCoord;
      let shortestDistance;
      let closestSegment;
      const loopThroughCoords = (coords) => {
        coords.forEach(
          (coord, index) => {
            if (Array.isArray(coord)) {
              loopThroughCoords(coord);
              return;
            }
            if (this.options.snapSegment) {
              const A = coord;
              let nextIndex;
              if (closedShape) {
                nextIndex = index + 1 === coords.length ? 0 : index + 1;
              } else {
                nextIndex = index + 1 === coords.length ? void 0 : index + 1;
              }
              const B3 = coords[nextIndex];
              if (B3) {
                const distance2 = this._getDistanceToSegment(map, latlng, A, B3);
                if (shortestDistance === void 0 || distance2 < shortestDistance) {
                  shortestDistance = distance2;
                  closestSegment = [A, B3];
                }
              }
            } else {
              const distancePoint = this._getDistance(map, latlng, coord);
              if (shortestDistance === void 0 || distancePoint < shortestDistance) {
                shortestDistance = distancePoint;
                closestCoord = coord;
              }
            }
          }
        );
      };
      loopThroughCoords(latlngs);
      if (this.options.snapSegment) {
        const C = this._getClosestPointOnSegment(
          map,
          latlng,
          closestSegment[0],
          closestSegment[1]
        );
        return {
          latlng: { ...C },
          segment: closestSegment,
          distance: shortestDistance
        };
      }
      return {
        latlng: closestCoord,
        distance: shortestDistance
      };
    },
    _getClosestLayerByPriority(layers, amount = 1) {
      layers = layers.sort(
        (a, b) => a._leaflet_id - b._leaflet_id
      );
      const shapes = [
        "Marker",
        "CircleMarker",
        "Circle",
        "Line",
        "Polygon",
        "Rectangle"
      ];
      const order = this._map.pm.globalOptions.snappingOrder || [];
      let lastIndex = 0;
      const prioOrder = {};
      order.concat(shapes).forEach((shape) => {
        if (!prioOrder[shape]) {
          lastIndex += 1;
          prioOrder[shape] = lastIndex;
        }
      });
      layers.sort(prioritiseSort("instanceofShape", prioOrder));
      if (amount === 1) {
        return layers[0] || {};
      }
      return layers.slice(0, amount);
    },
    // we got the point we want to snap to (C), but we need to check if a coord of the polygon
    // receives priority over C as the snapping point. Let's check this here
    _checkPrioritiySnapping(closestLayer) {
      const map = this._map;
      const A = closestLayer.segment[0];
      const B3 = closestLayer.segment[1];
      const C = closestLayer.latlng;
      let snapLatlng = C;
      if (this.options.snapVertex) {
        const distanceAC = this._getDistance(map, A, C);
        const distanceBC = this._getDistance(map, B3, C);
        let closestVertexLatLng = distanceAC < distanceBC ? A : B3;
        let shortestDistance = distanceAC < distanceBC ? distanceAC : distanceBC;
        if (this.options.snapMiddle) {
          const M = L.PM.Utils.calcMiddleLatLng(map, A, B3);
          const distanceMC = this._getDistance(map, M, C);
          if (distanceMC < distanceAC && distanceMC < distanceBC) {
            closestVertexLatLng = M;
            shortestDistance = distanceMC;
          }
        }
        const priorityDistance = this.options.snapDistance;
        if (shortestDistance < priorityDistance) {
          snapLatlng = closestVertexLatLng;
        }
      }
      return { ...snapLatlng };
    },
    _unsnap() {
      delete this._snapLatLng;
    },
    _getClosestPointOnSegment(map, latlng, latlngA, latlngB) {
      let maxzoom = map.getMaxZoom();
      if (maxzoom === Infinity) {
        maxzoom = map.getZoom();
      }
      const P = map.project(latlng, maxzoom);
      const A = map.project(latlngA, maxzoom);
      const B3 = map.project(latlngB, maxzoom);
      const closest = L.LineUtil.closestPointOnSegment(P, A, B3);
      return map.unproject(closest, maxzoom);
    },
    _getDistanceToSegment(map, latlng, latlngA, latlngB) {
      const P = map.latLngToContainerPoint(latlng);
      const A = map.latLngToContainerPoint(latlngA);
      const B3 = map.latLngToContainerPoint(latlngB);
      return L.LineUtil.pointToSegmentDistance(P, A, B3);
    },
    _getDistance(map, latlngA, latlngB) {
      return map.latLngToContainerPoint(latlngA).distanceTo(map.latLngToContainerPoint(latlngB));
    }
  };
  var Snapping_default = SnapMixin;

  // src/js/Draw/L.PM.Draw.ts
  var Draw = L.Class.extend({
    includes: [Snapping_default, Events_default],
    options: {
      snappable: true,
      // TODO: next major Release, rename it to allowSnapping
      snapDistance: 20,
      snapMiddle: false,
      allowSelfIntersection: true,
      tooltips: true,
      templineStyle: {},
      hintlineStyle: {
        color: "#3388ff",
        dashArray: "5,5"
      },
      pathOptions: null,
      cursorMarker: true,
      finishOn: null,
      markerStyle: {
        draggable: true,
        icon: L.icon()
      },
      hideMiddleMarkers: false,
      minRadiusCircle: null,
      maxRadiusCircle: null,
      minRadiusCircleMarker: null,
      maxRadiusCircleMarker: null,
      resizeableCircleMarker: false,
      resizeableCircle: true,
      markerEditable: true,
      continueDrawing: false,
      snapSegment: true,
      requireSnapToFinish: false,
      rectangleAngle: 0,
      textOptions: {
        text: null,
        focusAfterDraw: null,
        removeIfEmpty: null,
        className: null
      },
      snapVertex: true
    },
    setOptions(options) {
      L.Util.setOptions(this, options);
      this.setStyle(this.options);
    },
    setStyle() {
    },
    getOptions() {
      return this.options;
    },
    initialize(map) {
      const defaultIcon = new L.Icon.Default();
      defaultIcon.options.tooltipAnchor = [0, 0];
      this.options.markerStyle.icon = defaultIcon;
      this._map = map;
      this.shapes = [
        "Marker",
        "CircleMarker",
        "Line",
        "Polygon",
        "Rectangle",
        "Circle",
        "Cut",
        "Text"
      ];
      this.shapes.forEach((shape) => {
        this[shape] = new L.PM.Draw[shape](this._map);
      });
      this.Marker.setOptions({ continueDrawing: true });
      this.CircleMarker.setOptions({ continueDrawing: true });
    },
    setPathOptions(options, mergeOptions = false) {
      if (!mergeOptions) {
        this.options.pathOptions = options;
      } else {
        this.options.pathOptions = (0, import_merge3.default)(this.options.pathOptions, options);
      }
    },
    getShapes() {
      return this.shapes;
    },
    getShape() {
      return this._shape;
    },
    enable(shape, options) {
      if (!shape) {
        throw new Error(
          `Error: Please pass a shape as a parameter. Possible shapes are: ${this.getShapes().join(
            ","
          )}`
        );
      }
      this.disable();
      this[shape].enable(options);
    },
    disable() {
      this.shapes.forEach((shape) => {
        this[shape].disable();
      });
    },
    addControls() {
      this.shapes.forEach((shape) => {
        this[shape].addButton();
      });
    },
    getActiveShape() {
      let enabledShape;
      this.shapes.forEach((shape) => {
        if (this[shape]._enabled) {
          enabledShape = shape;
        }
      });
      return enabledShape;
    },
    _setGlobalDrawMode() {
      if (this._shape === "Cut") {
        this._fireGlobalCutModeToggled();
      } else {
        this._fireGlobalDrawModeToggled();
      }
      const layers = [];
      this._map.eachLayer((layer) => {
        if (layer instanceof L.Polyline || layer instanceof L.Marker || layer instanceof L.Circle || layer instanceof L.CircleMarker || layer instanceof L.ImageOverlay) {
          if (!layer._pmTempLayer) {
            layers.push(layer);
          }
        }
      });
      if (this._enabled) {
        layers.forEach((layer) => {
          L.PM.Utils.disablePopup(layer);
        });
      } else {
        layers.forEach((layer) => {
          L.PM.Utils.enablePopup(layer);
        });
      }
    },
    createNewDrawInstance(name, jsClass) {
      const instance = this._getShapeFromBtnName(jsClass);
      if (this[name]) {
        throw new TypeError("Draw Type already exists");
      }
      if (!L.PM.Draw[instance]) {
        throw new TypeError(`There is no class L.PM.Draw.${instance}`);
      }
      this[name] = new L.PM.Draw[instance](this._map);
      this[name].toolbarButtonName = name;
      this[name]._shape = name;
      this.shapes.push(name);
      if (this[jsClass]) {
        this[name].setOptions(
          this[jsClass].options
        );
      }
      this[name].setOptions(
        this[name].options
      );
      return this[name];
    },
    _getShapeFromBtnName(name) {
      const shapeMapping = {
        drawMarker: "Marker",
        drawCircle: "Circle",
        drawPolygon: "Polygon",
        drawPolyline: "Line",
        drawRectangle: "Rectangle",
        drawCircleMarker: "CircleMarker",
        editMode: "Edit",
        dragMode: "Drag",
        cutPolygon: "Cut",
        removalMode: "Removal",
        rotateMode: "Rotate",
        drawText: "Text"
      };
      if (shapeMapping[name]) {
        return shapeMapping[name];
      }
      return this[name] ? this[name]._shape : name;
    },
    _finishLayer(layer) {
      if (layer.pm) {
        layer.pm.setOptions(this.options);
        layer.pm._shape = this._shape;
        layer.pm._map = this._map;
      }
      this._addDrawnLayerProp(layer);
    },
    _addDrawnLayerProp(layer) {
      layer._drawnByGeoman = true;
    },
    _setPane(layer, type) {
      if (type === "layerPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.layerPane || "overlayPane";
      } else if (type === "vertexPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.vertexPane || "markerPane";
      } else if (type === "markerPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.markerPane || "markerPane";
      }
    },
    _isFirstLayer() {
      const map = this._map || this._layer._map;
      return map.pm.getGeomanLayers().length === 0;
    }
  });
  var L_PM_Draw_default = Draw;

  // src/js/Draw/L.PM.Draw.Marker.ts
  L_PM_Draw_default.Marker = L_PM_Draw_default.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Marker";
      this.toolbarButtonName = "drawMarker";
      this._layerIsDragging = false;
    },
    enable(options) {
      L.Util.setOptions(this, options);
      this._enabled = true;
      this._isTouchDevice = !hasFinePointer();
      this._map.getContainer().classList.add("geoman-draw-cursor");
      this._map.on("click", this._createMarker, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, true);
      if (this._isTouchDevice) {
        this._createTouchHint();
        this._hintMarker = L.marker(this._map.getCenter(), {
          ...this.options.markerStyle,
          opacity: 0,
          interactive: false
        });
        this._setPane(this._hintMarker, "markerPane");
        this._hintMarker._pmTempLayer = true;
      } else {
        this._hintMarker = L.marker(
          this._map.getCenter(),
          this.options.markerStyle
        );
        this._setPane(this._hintMarker, "markerPane");
        this._hintMarker._pmTempLayer = true;
        this._hintMarker.addTo(this._map);
        if (this.options.tooltips) {
          this._hintMarker.bindTooltip(getTranslation("tooltips.placeMarker"), {
            permanent: true,
            offset: L.point(0, 10),
            direction: "bottom",
            opacity: 0.8
          }).openTooltip();
        }
        this._map.on("mousemove", this._syncHintMarker, this);
      }
      this._layer = this._hintMarker;
      if (this.options.markerEditable) {
        this._map.eachLayer((layer) => {
          if (this.isRelevantMarker(layer)) {
            layer.pm.enable();
          }
        });
      }
      this._fireDrawStart();
      this._setGlobalDrawMode();
    },
    disable() {
      if (!this._enabled) {
        return;
      }
      this._enabled = false;
      this._map.getContainer().classList.remove("geoman-draw-cursor");
      this._map.off("click", this._createMarker, this);
      if (this._isTouchDevice) {
        this._removeTouchHint();
        this._hintMarker = null;
      } else {
        this._hintMarker.remove();
        this._map.off("mousemove", this._syncHintMarker, this);
      }
      this._map.eachLayer((layer) => {
        if (this.isRelevantMarker(layer)) {
          layer.pm.disable();
        }
      });
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, false);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      this._fireDrawEnd();
      this._setGlobalDrawMode();
    },
    enabled() {
      return this._enabled;
    },
    toggle(options) {
      if (this.enabled()) {
        this.disable();
      } else {
        this.enable(options);
      }
    },
    isRelevantMarker(layer) {
      return layer instanceof L.Marker && layer.pm && !layer._pmTempLayer && !layer.pm._initTextMarker;
    },
    _syncHintMarker(e) {
      this._hintMarker.setLatLng(e.latlng);
      if (this.options.snappable) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent);
      }
      this._fireChange(this._hintMarker.getLatLng(), "Draw");
    },
    _createMarker(e) {
      if (!e.latlng || this._layerIsDragging) {
        return;
      }
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const latlng = this._hintMarker.getLatLng();
      const marker = new L.Marker(latlng, this.options.markerStyle);
      this._setPane(marker, "markerPane");
      this._finishLayer(marker);
      if (!marker.pm) {
        marker.options.draggable = false;
      }
      marker.addTo(this._map.pm._getContainingLayer());
      if (marker.pm && this.options.markerEditable) {
        marker.pm.enable();
      } else if (marker.dragging) {
        marker.dragging.disable();
      }
      this._fireCreate(marker);
      this._cleanupSnapping();
      if (!this.options.continueDrawing) {
        this.disable();
      }
    },
    setStyle() {
      if (this.options.markerStyle?.icon) {
        this._hintMarker?.setIcon(this.options.markerStyle.icon);
      }
    },
    _createTouchHint() {
      if (!this.options.tooltips) {
        return;
      }
      this._touchHint = L.DomUtil.create("div", "leaflet-pm-touch-hint");
      this._touchHint.textContent = getTranslation("tooltips.placeMarkerTouch");
      this._map.getContainer().appendChild(this._touchHint);
    },
    _removeTouchHint() {
      if (this._touchHint && this._touchHint.parentNode) {
        this._touchHint.parentNode.removeChild(this._touchHint);
        this._touchHint = null;
      }
    }
  });

  // node_modules/.pnpm/@turf+helpers@7.4.0/node_modules/@turf/helpers/dist/esm/index.js
  var earthRadius = 63710088e-1;
  var factors = {
    centimeters: earthRadius * 100,
    centimetres: earthRadius * 100,
    cm: earthRadius * 100,
    degrees: 360 / (2 * Math.PI),
    deg: 360 / (2 * Math.PI),
    feet: earthRadius * 3.28084,
    ft: earthRadius * 3.28084,
    inches: earthRadius * 39.37,
    in: earthRadius * 39.37,
    kilometers: earthRadius / 1e3,
    kilometres: earthRadius / 1e3,
    km: earthRadius / 1e3,
    meters: earthRadius,
    metres: earthRadius,
    m: earthRadius,
    miles: earthRadius / 1609.344,
    mi: earthRadius / 1609.344,
    millimeters: earthRadius * 1e3,
    millimetres: earthRadius * 1e3,
    mm: earthRadius * 1e3,
    nauticalmiles: earthRadius / 1852,
    nmi: earthRadius / 1852,
    radians: 1,
    rad: 1,
    yards: earthRadius * 1.0936,
    yd: earthRadius * 1.0936
  };
  function feature(geom, properties, options = {}) {
    const feat = { type: "Feature" };
    if (options.id === 0 || options.id) {
      feat.id = options.id;
    }
    if (options.bbox) {
      feat.bbox = options.bbox;
    }
    feat.properties = properties || {};
    feat.geometry = geom;
    return feat;
  }
  function point(coordinates, properties, options = {}) {
    if (!coordinates) {
      throw new Error("coordinates is required");
    }
    if (!Array.isArray(coordinates)) {
      throw new Error("coordinates must be an Array");
    }
    if (coordinates.length < 2) {
      throw new Error("coordinates must be at least 2 numbers long");
    }
    if (!isNumber(coordinates[0]) || !isNumber(coordinates[1])) {
      throw new Error("coordinates must contain numbers");
    }
    const geom = {
      type: "Point",
      coordinates
    };
    return feature(geom, properties, options);
  }
  function lineString(coordinates, properties, options = {}) {
    if (coordinates.length < 2) {
      throw new Error("coordinates must be an array of two or more positions");
    }
    const geom = {
      type: "LineString",
      coordinates
    };
    return feature(geom, properties, options);
  }
  function featureCollection(features, options = {}) {
    const fc = { type: "FeatureCollection" };
    if (options.id) {
      fc.id = options.id;
    }
    if (options.bbox) {
      fc.bbox = options.bbox;
    }
    fc.features = features;
    return fc;
  }
  function radiansToLength(radians, units = "kilometers") {
    const factor = factors[units];
    if (!factor) {
      throw new Error(units + " units is invalid");
    }
    return radians * factor;
  }
  function radiansToDegrees(radians) {
    const normalisedRadians = radians % (2 * Math.PI);
    return normalisedRadians * 180 / Math.PI;
  }
  function degreesToRadians(degrees) {
    const normalisedDegrees = degrees % 360;
    return normalisedDegrees * Math.PI / 180;
  }
  function isNumber(num) {
    return !isNaN(num) && num !== null && !Array.isArray(num);
  }
  function isObject(input) {
    return input !== null && typeof input === "object" && !Array.isArray(input);
  }

  // node_modules/.pnpm/@turf+kinks@7.4.0/node_modules/@turf/kinks/dist/esm/index.js
  function kinks(featureIn) {
    let coordinates;
    let feature3;
    const results = {
      type: "FeatureCollection",
      features: []
    };
    if (featureIn.type === "Feature") {
      feature3 = featureIn.geometry;
    } else {
      feature3 = featureIn;
    }
    if (feature3.type === "LineString") {
      coordinates = [feature3.coordinates];
    } else if (feature3.type === "MultiLineString") {
      coordinates = feature3.coordinates;
    } else if (feature3.type === "MultiPolygon") {
      coordinates = [].concat(...feature3.coordinates);
    } else if (feature3.type === "Polygon") {
      coordinates = feature3.coordinates;
    } else {
      throw new Error(
        "Input must be a LineString, MultiLineString, Polygon, or MultiPolygon Feature or Geometry"
      );
    }
    coordinates.forEach((line1) => {
      coordinates.forEach((line2) => {
        for (let i = 0; i < line1.length - 1; i++) {
          for (let k = i; k < line2.length - 1; k++) {
            if (line1 === line2) {
              if (Math.abs(i - k) === 1) {
                continue;
              }
              if (
                // segments are first and last segment of lineString
                i === 0 && k === line1.length - 2 && // lineString is closed
                line1[i][0] === line1[line1.length - 1][0] && line1[i][1] === line1[line1.length - 1][1]
              ) {
                continue;
              }
            }
            const intersection3 = lineIntersects(
              line1[i][0],
              line1[i][1],
              line1[i + 1][0],
              line1[i + 1][1],
              line2[k][0],
              line2[k][1],
              line2[k + 1][0],
              line2[k + 1][1]
            );
            if (intersection3) {
              results.features.push(point([intersection3[0], intersection3[1]]));
            }
          }
        }
      });
    });
    return results;
  }
  function lineIntersects(line1StartX, line1StartY, line1EndX, line1EndY, line2StartX, line2StartY, line2EndX, line2EndY) {
    let denominator;
    let a;
    let b;
    let numerator1;
    let numerator2;
    const result = {
      x: null,
      y: null,
      onLine1: false,
      onLine2: false
    };
    denominator = (line2EndY - line2StartY) * (line1EndX - line1StartX) - (line2EndX - line2StartX) * (line1EndY - line1StartY);
    if (denominator === 0) {
      if (result.x !== null && result.y !== null) {
        return result;
      } else {
        return false;
      }
    }
    a = line1StartY - line2StartY;
    b = line1StartX - line2StartX;
    numerator1 = (line2EndX - line2StartX) * a - (line2EndY - line2StartY) * b;
    numerator2 = (line1EndX - line1StartX) * a - (line1EndY - line1StartY) * b;
    a = numerator1 / denominator;
    b = numerator2 / denominator;
    result.x = line1StartX + a * (line1EndX - line1StartX);
    result.y = line1StartY + a * (line1EndY - line1StartY);
    if (a >= 0 && a <= 1) {
      result.onLine1 = true;
    }
    if (b >= 0 && b <= 1) {
      result.onLine2 = true;
    }
    if (result.onLine1 && result.onLine2) {
      return [result.x, result.y];
    } else {
      return false;
    }
  }
  var index_default = kinks;

  // src/js/Draw/L.PM.Draw.Line.ts
  L_PM_Draw_default.Line = L_PM_Draw_default.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Line";
      this.toolbarButtonName = "drawPolyline";
      this._doesSelfIntersect = false;
    },
    enable(options) {
      L.Util.setOptions(this, options);
      this._enabled = true;
      this._markers = [];
      this._layerGroup = new L.FeatureGroup();
      this._layerGroup._pmTempLayer = true;
      this._layerGroup.addTo(this._map);
      this._layer = L.polyline([], {
        ...this.options.templineStyle,
        pmIgnore: false
      });
      this._setPane(this._layer, "layerPane");
      this._layer._pmTempLayer = true;
      this._layerGroup.addLayer(this._layer);
      this._hintline = L.polyline([], this.options.hintlineStyle);
      this._setPane(this._hintline, "layerPane");
      this._hintline._pmTempLayer = true;
      this._layerGroup.addLayer(this._hintline);
      this._hintMarker = L.marker(this._map.getCenter(), {
        interactive: false,
        // always vertex marker below will be triggered from the click event -> _finishShape #911
        zIndexOffset: 100,
        icon: L.divIcon({ className: "marker-icon cursor-marker" })
      });
      this._setPane(this._hintMarker, "vertexPane");
      this._hintMarker._pmTempLayer = true;
      this._layerGroup.addLayer(this._hintMarker);
      if (this.options.cursorMarker) {
        L.DomUtil.addClass(this._hintMarker._icon, "visible");
      }
      if (this.options.tooltips) {
        this._hintMarker.bindTooltip(getTranslation("tooltips.firstVertex"), {
          permanent: true,
          offset: L.point(0, 10),
          direction: "bottom",
          opacity: 0.8
        }).openTooltip();
      }
      this._map.getContainer().classList.add("geoman-draw-cursor");
      this._map.on("click", this._createVertex, this);
      if (this.options.finishOn && this.options.finishOn !== "snap") {
        this._map.on(
          this.options.finishOn,
          this._finishShape,
          this
        );
      }
      if (this.options.finishOn === "dblclick") {
        this.tempMapDoubleClickZoomState = this._map.doubleClickZoom._enabled;
        if (this.tempMapDoubleClickZoomState) {
          this._map.doubleClickZoom.disable();
        }
      }
      this._map.on("mousemove", this._syncHintMarker, this);
      this._hintMarker.on("move", this._syncHintLine, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, true);
      this._otherSnapLayers = [];
      this.isRed = false;
      this._fireDrawStart();
      this._setGlobalDrawMode();
    },
    disable() {
      if (!this._enabled) {
        return;
      }
      this._enabled = false;
      this._map.getContainer().classList.remove("geoman-draw-cursor");
      this._map.off("click", this._createVertex, this);
      this._map.off("mousemove", this._syncHintMarker, this);
      if (this.options.finishOn && this.options.finishOn !== "snap") {
        this._map.off(
          this.options.finishOn,
          this._finishShape,
          this
        );
      }
      if (this.tempMapDoubleClickZoomState) {
        this._map.doubleClickZoom.enable();
      }
      this._map.removeLayer(this._layerGroup);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, false);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      this._fireDrawEnd();
      this._setGlobalDrawMode();
    },
    enabled() {
      return this._enabled;
    },
    toggle(options) {
      if (this.enabled()) {
        this.disable();
      } else {
        this.enable(options);
      }
    },
    _syncHintLine() {
      const polyPoints = this._layer.getLatLngs();
      if (polyPoints.length > 0) {
        const lastPolygonPoint = polyPoints[polyPoints.length - 1];
        this._hintline.setLatLngs([
          lastPolygonPoint,
          this._hintMarker.getLatLng()
        ]);
      }
    },
    _syncHintMarker(e) {
      this._hintMarker.setLatLng(e.latlng);
      if (this.options.snappable) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent);
      } else if (this._otherSnapLayers && this._otherSnapLayers.length > 0) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent, true);
      }
      if (!this.options.allowSelfIntersection) {
        this._handleSelfIntersection(true, this._hintMarker.getLatLng());
      }
      const latlngs = this._layer._defaultShape().slice();
      latlngs.push(this._hintMarker.getLatLng());
      this._change(latlngs);
    },
    hasSelfIntersection() {
      const selfIntersection = index_default(this._layer.toGeoJSON(15));
      return selfIntersection.features.length > 0;
    },
    _handleSelfIntersection(addVertex, latlng) {
      const clone2 = L.polyline(this._layer.getLatLngs());
      if (addVertex) {
        if (!latlng) {
          latlng = this._hintMarker.getLatLng();
        }
        clone2.addLatLng(latlng);
      }
      const selfIntersection = index_default(clone2.toGeoJSON(15));
      this._doesSelfIntersect = selfIntersection.features.length > 0;
      if (this._doesSelfIntersect) {
        if (!this.isRed) {
          this.isRed = true;
          this._hintline.setStyle({
            color: "#f00000ff"
          });
          this._fireIntersect(selfIntersection, this._map, "Draw");
        }
      } else if (!this._hintline.isEmpty()) {
        this.isRed = false;
        this._hintline.setStyle(this.options.hintlineStyle);
      }
    },
    _createVertex(e) {
      if (!this.options.allowSelfIntersection) {
        this._handleSelfIntersection(true, e.latlng);
        if (this._doesSelfIntersect) {
          return;
        }
      }
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const latlng = this._hintMarker.getLatLng();
      const latlngs = this._layer.getLatLngs();
      const lastLatLng = latlngs[latlngs.length - 1];
      if (latlng.equals(latlngs[0]) || latlngs.length > 0 && latlng.equals(lastLatLng)) {
        this._finishShape();
        return;
      }
      this._layer._latlngInfo = this._layer._latlngInfo || [];
      this._layer._latlngInfo.push({
        latlng,
        snapInfo: this._hintMarker._snapInfo
      });
      this._layer.addLatLng(latlng);
      const newMarker = this._createMarker(latlng);
      this._setTooltipText();
      this._setHintLineAfterNewVertex(latlng);
      this._fireVertexAdded(newMarker, void 0, latlng, "Draw");
      this._change(this._layer.getLatLngs());
      if (this.options.finishOn === "snap" && this._hintMarker._snapped) {
        this._finishShape(e);
      }
    },
    _setHintLineAfterNewVertex(hintMarkerLatLng) {
      this._hintline.setLatLngs([hintMarkerLatLng, hintMarkerLatLng]);
    },
    _removeLastVertex() {
      const markers = this._markers;
      if (markers.length <= 1) {
        this.disable();
        return;
      }
      let coords = this._layer.getLatLngs();
      const removedMarker = markers[markers.length - 1];
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        markers,
        removedMarker
      );
      markers.pop();
      this._layerGroup.removeLayer(removedMarker);
      const markerPrevious = markers[markers.length - 1];
      const indexMarkerPrev = coords.indexOf(markerPrevious.getLatLng());
      coords = coords.slice(0, indexMarkerPrev + 1);
      this._layer.setLatLngs(coords);
      this._layer._latlngInfo.pop();
      this._syncHintLine();
      this._setTooltipText();
      this._fireVertexRemoved(removedMarker, indexPath, "Draw");
      this._change(this._layer.getLatLngs());
    },
    _finishShape() {
      if (!this.options.allowSelfIntersection) {
        this._handleSelfIntersection(false);
        if (this._doesSelfIntersect) {
          return;
        }
      }
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      const coords = this._layer.getLatLngs();
      if (coords.length <= 1) {
        return;
      }
      const polylineLayer = L.polyline(coords, this.options.pathOptions);
      this._setPane(polylineLayer, "layerPane");
      this._finishLayer(polylineLayer);
      polylineLayer.addTo(this._map.pm._getContainingLayer());
      this._fireCreate(polylineLayer);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      const hintMarkerLatLng = this._hintMarker.getLatLng();
      this.disable();
      if (this.options.continueDrawing) {
        this.enable();
        this._hintMarker.setLatLng(hintMarkerLatLng);
      }
    },
    _createMarker(latlng) {
      const marker = new L.Marker(latlng, {
        draggable: false,
        icon: L.divIcon({ className: "marker-icon" })
      });
      this._setPane(marker, "vertexPane");
      marker._pmTempLayer = true;
      this._layerGroup.addLayer(marker);
      this._markers.push(marker);
      marker.on("click", this._finishShape, this);
      return marker;
    },
    _setTooltipText() {
      const { length: length2 } = this._layer.getLatLngs().flat();
      let text = "";
      if (length2 <= 1) {
        text = getTranslation("tooltips.continueLine");
      } else {
        text = getTranslation("tooltips.finishLine");
      }
      this._hintMarker.setTooltipContent(text);
    },
    _change(latlngs) {
      this._fireChange(latlngs, "Draw");
    },
    setStyle() {
      this._layer?.setStyle(this.options.templineStyle);
      this._hintline?.setStyle(this.options.hintlineStyle);
    }
  });

  // src/js/Draw/L.PM.Draw.Polygon.ts
  L_PM_Draw_default.Polygon = L_PM_Draw_default.Line.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Polygon";
      this.toolbarButtonName = "drawPolygon";
    },
    enable(options) {
      L.PM.Draw.Line.prototype.enable.call(this, options);
      this._layer.pm._shape = "Polygon";
    },
    _createMarker(latlng) {
      const marker = new L.Marker(latlng, {
        draggable: false,
        icon: L.divIcon({ className: "marker-icon" })
      });
      this._setPane(marker, "vertexPane");
      marker._pmTempLayer = true;
      this._layerGroup.addLayer(marker);
      this._markers.push(marker);
      if (this._layer.getLatLngs().flat().length === 1) {
        marker.on("click", this._finishShape, this);
        this._tempSnapLayerIndex = this._otherSnapLayers.push(marker) - 1;
        if (this.options.snappable) {
          this._cleanupSnapping();
        }
      } else {
        marker.on("click", () => 1);
      }
      return marker;
    },
    _setTooltipText() {
      const { length: length2 } = this._layer.getLatLngs().flat();
      let text = "";
      if (length2 <= 2) {
        text = getTranslation("tooltips.continueLine");
      } else {
        text = getTranslation("tooltips.finishPoly");
      }
      this._hintMarker.setTooltipContent(text);
    },
    _finishShape() {
      if (!this.options.allowSelfIntersection) {
        this._handleSelfIntersection(
          true,
          this._layer.getLatLngs()[0]
        );
        if (this._doesSelfIntersect) {
          return;
        }
      }
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      const coords = this._layer.getLatLngs();
      if (coords.length <= 2) {
        return;
      }
      const polygonLayer = L.polygon(coords, this.options.pathOptions);
      this._setPane(polygonLayer, "layerPane");
      this._finishLayer(polygonLayer);
      polygonLayer.addTo(this._map.pm._getContainingLayer());
      this._fireCreate(polygonLayer);
      this._cleanupSnapping();
      this._otherSnapLayers.splice(this._tempSnapLayerIndex, 1);
      delete this._tempSnapLayerIndex;
      const hintMarkerLatLng = this._hintMarker.getLatLng();
      this.disable();
      if (this.options.continueDrawing) {
        this.enable();
        this._hintMarker.setLatLng(hintMarkerLatLng);
      }
    }
  });

  // src/js/Draw/L.PM.Draw.Rectangle.ts
  L_PM_Draw_default.Rectangle = L_PM_Draw_default.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Rectangle";
      this.toolbarButtonName = "drawRectangle";
    },
    enable(options) {
      L.Util.setOptions(this, options);
      this._enabled = true;
      this._layerGroup = new L.FeatureGroup();
      this._layerGroup._pmTempLayer = true;
      this._layerGroup.addTo(this._map);
      this._layer = L.rectangle(
        [
          [0, 0],
          [0, 0]
        ],
        this.options.pathOptions
      );
      this._setPane(this._layer, "layerPane");
      this._layer._pmTempLayer = true;
      this._startMarker = L.marker(this._map.getCenter(), {
        icon: L.divIcon({ className: "marker-icon rect-start-marker" }),
        draggable: false,
        zIndexOffset: -100,
        opacity: this.options.cursorMarker ? 1 : 0
      });
      this._setPane(this._startMarker, "vertexPane");
      this._startMarker._pmTempLayer = true;
      this._layerGroup.addLayer(this._startMarker);
      this._hintMarker = L.marker(this._map.getCenter(), {
        zIndexOffset: 150,
        icon: L.divIcon({ className: "marker-icon cursor-marker" })
      });
      this._setPane(this._hintMarker, "vertexPane");
      this._hintMarker._pmTempLayer = true;
      this._layerGroup.addLayer(this._hintMarker);
      if (this.options.cursorMarker) {
        L.DomUtil.addClass(this._hintMarker._icon, "visible");
      }
      if (this.options.tooltips) {
        this._hintMarker.bindTooltip(getTranslation("tooltips.firstVertex"), {
          permanent: true,
          offset: L.point(0, 10),
          direction: "bottom",
          opacity: 0.8
        }).openTooltip();
      }
      if (this.options.cursorMarker) {
        this._styleMarkers = [];
        for (let i = 0; i < 2; i += 1) {
          const styleMarker = L.marker(this._map.getCenter(), {
            icon: L.divIcon({
              className: "marker-icon rect-style-marker"
            }),
            draggable: false,
            zIndexOffset: 100
          });
          this._setPane(styleMarker, "vertexPane");
          styleMarker._pmTempLayer = true;
          this._layerGroup.addLayer(styleMarker);
          this._styleMarkers.push(styleMarker);
        }
      }
      this._map.getContainer().classList.add("geoman-draw-cursor");
      this._map.on("click", this._placeStartingMarkers, this);
      this._map.on("mousemove", this._syncHintMarker, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, true);
      this._otherSnapLayers = [];
      this._fireDrawStart();
      this._setGlobalDrawMode();
    },
    disable() {
      if (!this._enabled) {
        return;
      }
      this._enabled = false;
      this._map.getContainer().classList.remove("geoman-draw-cursor");
      this._map.off("click", this._finishShape, this);
      this._map.off("click", this._placeStartingMarkers, this);
      this._map.off("mousemove", this._syncHintMarker, this);
      this._map.removeLayer(this._layerGroup);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, false);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      this._fireDrawEnd();
      this._setGlobalDrawMode();
    },
    enabled() {
      return this._enabled;
    },
    toggle(options) {
      if (this.enabled()) {
        this.disable();
      } else {
        this.enable(options);
      }
    },
    _placeStartingMarkers(e) {
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const latlng = this._hintMarker.getLatLng();
      L.DomUtil.addClass(this._startMarker._icon, "visible");
      this._startMarker.setLatLng(latlng);
      if (this.options.cursorMarker && this._styleMarkers) {
        this._styleMarkers.forEach((styleMarker) => {
          L.DomUtil.addClass(styleMarker._icon, "visible");
          styleMarker.setLatLng(latlng);
        });
      }
      this._map.off("click", this._placeStartingMarkers, this);
      this._map.on("click", this._finishShape, this);
      this._hintMarker.setTooltipContent(getTranslation("tooltips.finishRect"));
      this._setRectangleOrigin();
    },
    _setRectangleOrigin() {
      const latlng = this._startMarker.getLatLng();
      if (latlng) {
        this._layerGroup.addLayer(this._layer);
        this._layer.setLatLngs([latlng, latlng]);
        this._hintMarker.on("move", this._syncRectangleSize, this);
      }
    },
    _syncHintMarker(e) {
      this._hintMarker.setLatLng(e.latlng);
      if (this.options.snappable) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent);
      }
      const latlngs = this._layerGroup && this._layerGroup.hasLayer(this._layer) ? this._layer.getLatLngs() : [this._hintMarker.getLatLng()];
      this._fireChange(latlngs, "Draw");
    },
    _syncRectangleSize() {
      const A = fixLatOffset(this._startMarker.getLatLng(), this._map);
      const B3 = fixLatOffset(this._hintMarker.getLatLng(), this._map);
      const corners = L.PM.Utils._getRotatedRectangle(
        A,
        B3,
        this.options.rectangleAngle || 0,
        this._map
      );
      this._layer.setLatLngs(corners);
      if (this.options.cursorMarker && this._styleMarkers) {
        const unmarkedCorners = [];
        corners.forEach((corner) => {
          if (!corner.equals(A, 1e-8) && !corner.equals(B3, 1e-8)) {
            unmarkedCorners.push(corner);
          }
        });
        unmarkedCorners.forEach((unmarkedCorner, index) => {
          try {
            this._styleMarkers[index].setLatLng(unmarkedCorner);
          } catch (e) {
          }
        });
      }
    },
    _findCorners() {
      const latlngs = this._layer.getLatLngs()[0];
      return L.PM.Utils._getRotatedRectangle(
        latlngs[0],
        latlngs[2],
        this.options.rectangleAngle || 0,
        this._map
      );
    },
    _finishShape(e) {
      if (e?.latlng && !this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const B3 = this._hintMarker.getLatLng();
      const A = this._startMarker.getLatLng();
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      if (A.equals(B3)) {
        return;
      }
      const rectangleLayer = L.rectangle(
        [A, B3],
        this.options.pathOptions
      );
      if (this.options.rectangleAngle) {
        const corners = L.PM.Utils._getRotatedRectangle(
          A,
          B3,
          this.options.rectangleAngle || 0,
          this._map
        );
        rectangleLayer.setLatLngs(corners);
        if (rectangleLayer.pm) {
          rectangleLayer.pm._setAngle(this.options.rectangleAngle || 0);
        }
      }
      this._setPane(rectangleLayer, "layerPane");
      this._finishLayer(rectangleLayer);
      rectangleLayer.addTo(this._map.pm._getContainingLayer());
      this._fireCreate(rectangleLayer);
      const hintMarkerLatLng = this._hintMarker.getLatLng();
      this.disable();
      if (this.options.continueDrawing) {
        this.enable();
        this._hintMarker.setLatLng(hintMarkerLatLng);
      }
    },
    setStyle() {
      this._layer?.setStyle(this.options.pathOptions);
    }
  });

  // src/js/Draw/L.PM.Draw.CircleMarker.ts
  L_PM_Draw_default.CircleMarker = L_PM_Draw_default.extend({
    initialize(map) {
      this._map = map;
      this._shape = "CircleMarker";
      this.toolbarButtonName = "drawCircleMarker";
      this._layerIsDragging = false;
      this._BaseCircleClass = L.CircleMarker;
      this._minRadiusOption = "minRadiusCircleMarker";
      this._maxRadiusOption = "maxRadiusCircleMarker";
      this._editableOption = "resizeableCircleMarker";
      this._defaultRadius = 10;
    },
    enable(options) {
      L.Util.setOptions(this, options);
      if (this.options.editable) {
        this.options.resizeableCircleMarker = this.options.editable;
        delete this.options.editable;
      }
      this._enabled = true;
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, true);
      this._map.getContainer().classList.add("geoman-draw-cursor");
      if (this.options[this._editableOption]) {
        const templineStyle = {};
        L.extend(templineStyle, this.options.templineStyle);
        templineStyle.radius = 0;
        this._layerGroup = new L.FeatureGroup();
        this._layerGroup._pmTempLayer = true;
        this._layerGroup.addTo(this._map);
        this._layer = new this._BaseCircleClass(
          this._map.getCenter(),
          templineStyle
        );
        this._setPane(this._layer, "layerPane");
        this._layer._pmTempLayer = true;
        this._centerMarker = L.marker(this._map.getCenter(), {
          icon: L.divIcon({ className: "marker-icon" }),
          draggable: false,
          zIndexOffset: 100
        });
        this._setPane(this._centerMarker, "vertexPane");
        this._centerMarker._pmTempLayer = true;
        this._hintMarker = L.marker(this._map.getCenter(), {
          zIndexOffset: 110,
          icon: L.divIcon({ className: "marker-icon cursor-marker" })
        });
        this._setPane(this._hintMarker, "vertexPane");
        this._hintMarker._pmTempLayer = true;
        this._layerGroup.addLayer(this._hintMarker);
        if (this.options.cursorMarker) {
          L.DomUtil.addClass(this._hintMarker._icon, "visible");
        }
        if (this.options.tooltips) {
          this._hintMarker.bindTooltip(getTranslation("tooltips.startCircle"), {
            permanent: true,
            offset: L.point(0, 10),
            direction: "bottom",
            opacity: 0.8
          }).openTooltip();
        }
        this._hintline = L.polyline([], this.options.hintlineStyle);
        this._setPane(this._hintline, "layerPane");
        this._hintline._pmTempLayer = true;
        this._layerGroup.addLayer(this._hintline);
        this._map.on("click", this._placeCenterMarker, this);
      } else {
        this._map.on("click", this._createMarker, this);
        this._hintMarker = new this._BaseCircleClass(this._map.getCenter(), {
          radius: this._defaultRadius,
          ...this.options.templineStyle
        });
        this._setPane(this._hintMarker, "layerPane");
        this._hintMarker._pmTempLayer = true;
        this._hintMarker.addTo(this._map);
        this._layer = this._hintMarker;
        if (this.options.tooltips) {
          this._hintMarker.bindTooltip(getTranslation("tooltips.placeCircleMarker"), {
            permanent: true,
            offset: L.point(0, 10),
            direction: "bottom",
            opacity: 0.8
          }).openTooltip();
        }
      }
      this._map.on("mousemove", this._syncHintMarker, this);
      this._extendingEnable();
      this._otherSnapLayers = [];
      this._fireDrawStart();
      this._setGlobalDrawMode();
    },
    _extendingEnable() {
      if (!this.options[this._editableOption] && this.options.markerEditable) {
        this._map.eachLayer((layer) => {
          if (this.isRelevantMarker(layer)) {
            layer.pm.enable();
          }
        });
      }
      this._layer.bringToBack();
    },
    disable() {
      if (!this._enabled) {
        return;
      }
      this._enabled = false;
      this._map.getContainer().classList.remove("geoman-draw-cursor");
      if (this.options[this._editableOption]) {
        this._map.off("click", this._finishShape, this);
        this._map.off("click", this._placeCenterMarker, this);
        this._map.removeLayer(this._layerGroup);
      } else {
        this._map.off("click", this._createMarker, this);
        this._extendingDisable();
        this._hintMarker.remove();
      }
      this._map.off("mousemove", this._syncHintMarker, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, false);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      this._fireDrawEnd();
      this._setGlobalDrawMode();
    },
    _extendingDisable() {
      this._map.eachLayer((layer) => {
        if (this.isRelevantMarker(layer)) {
          layer.pm.disable();
        }
      });
    },
    enabled() {
      return this._enabled;
    },
    toggle(options) {
      if (this.enabled()) {
        this.disable();
      } else {
        this.enable(options);
      }
    },
    _placeCenterMarker(e) {
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      this._layerGroup.addLayer(this._layer);
      this._layerGroup.addLayer(this._centerMarker);
      const latlng = this._hintMarker.getLatLng();
      this._centerMarker.setLatLng(latlng);
      this._map.off("click", this._placeCenterMarker, this);
      this._map.on("click", this._finishShape, this);
      this._placeCircleCenter();
    },
    _placeCircleCenter() {
      const latlng = this._centerMarker.getLatLng();
      if (latlng) {
        this._layer.setLatLng(latlng);
        this._hintMarker.on("move", this._syncHintLine, this);
        this._hintMarker.on("move", this._syncCircleRadius, this);
        this._hintMarker.setTooltipContent(
          getTranslation("tooltips.finishCircle")
        );
        this._fireCenterPlaced();
        this._fireChange(this._layer.getLatLng(), "Draw");
      }
    },
    _syncHintLine() {
      const latlng = this._centerMarker.getLatLng();
      const secondLatLng = this._getNewDestinationOfHintMarker();
      this._hintline.setLatLngs([latlng, secondLatLng]);
    },
    _syncCircleRadius() {
      const A = this._centerMarker.getLatLng();
      const B3 = this._hintMarker.getLatLng();
      const distance2 = this._distanceCalculation(A, B3);
      if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
        this._layer.setRadius(this.options[this._minRadiusOption]);
      } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
        this._layer.setRadius(this.options[this._maxRadiusOption]);
      } else {
        this._layer.setRadius(distance2);
      }
    },
    _syncHintMarker(e) {
      this._hintMarker.setLatLng(e.latlng);
      this._hintMarker.setLatLng(this._getNewDestinationOfHintMarker());
      if (this.options.snappable) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent);
      }
      this._handleHintMarkerSnapping();
      const latlng = this._layerGroup && this._layerGroup.hasLayer(this._centerMarker) ? this._centerMarker.getLatLng() : this._hintMarker.getLatLng();
      this._fireChange(latlng, "Draw");
    },
    isRelevantMarker(layer) {
      return layer instanceof L.CircleMarker && !(layer instanceof L.Circle) && layer.pm && !layer._pmTempLayer;
    },
    _createMarker(e) {
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      if (!e.latlng || this._layerIsDragging) {
        return;
      }
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const latlng = this._hintMarker.getLatLng();
      const marker = new this._BaseCircleClass(latlng, {
        radius: this._defaultRadius,
        ...this.options.pathOptions
      });
      this._setPane(marker, "layerPane");
      this._finishLayer(marker);
      marker.addTo(this._map.pm._getContainingLayer());
      this._extendingCreateMarker(marker);
      this._fireCreate(marker);
      this._cleanupSnapping();
      if (!this.options.continueDrawing) {
        this.disable();
      }
    },
    _extendingCreateMarker(marker) {
      if (marker.pm && this.options.markerEditable) {
        marker.pm.enable();
      }
    },
    _finishShape(e) {
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      if (e?.latlng && !this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const center = this._centerMarker.getLatLng();
      let radius = this._defaultRadius;
      if (this.options[this._editableOption]) {
        const latlng = this._hintMarker.getLatLng();
        radius = this._distanceCalculation(center, latlng);
        if (this.options[this._minRadiusOption] && radius < this.options[this._minRadiusOption]) {
          radius = this.options[this._minRadiusOption];
        } else if (this.options[this._maxRadiusOption] && radius > this.options[this._maxRadiusOption]) {
          radius = this.options[this._maxRadiusOption];
        }
      }
      const options = { ...this.options.pathOptions, radius };
      const circleLayer = new this._BaseCircleClass(center, options);
      this._setPane(circleLayer, "layerPane");
      this._finishLayer(circleLayer);
      circleLayer.addTo(this._map.pm._getContainingLayer());
      if (circleLayer.pm) {
        circleLayer.pm._updateHiddenPolyCircle();
      }
      this._fireCreate(circleLayer);
      const hintMarkerLatLng = this._hintMarker.getLatLng();
      this.disable();
      if (this.options.continueDrawing) {
        this.enable();
        this._hintMarker.setLatLng(hintMarkerLatLng);
      }
    },
    _getNewDestinationOfHintMarker() {
      let secondLatLng = this._hintMarker.getLatLng();
      if (this.options[this._editableOption]) {
        if (!this._layerGroup.hasLayer(this._centerMarker)) {
          return secondLatLng;
        }
        const latlng = this._centerMarker.getLatLng();
        const distance2 = this._distanceCalculation(latlng, secondLatLng);
        if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
          secondLatLng = destinationOnLine(
            this._map,
            latlng,
            secondLatLng,
            this._getMinDistanceInMeter()
          );
        } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
          secondLatLng = destinationOnLine(
            this._map,
            latlng,
            secondLatLng,
            this._getMaxDistanceInMeter()
          );
        }
      }
      return secondLatLng;
    },
    _getMinDistanceInMeter() {
      return L.PM.Utils.pxRadiusToMeterRadius(
        this.options[this._minRadiusOption],
        this._map,
        this._centerMarker.getLatLng()
      );
    },
    _getMaxDistanceInMeter() {
      return L.PM.Utils.pxRadiusToMeterRadius(
        this.options[this._maxRadiusOption],
        this._map,
        this._centerMarker.getLatLng()
      );
    },
    _handleHintMarkerSnapping() {
      if (this.options[this._editableOption]) {
        if (this._hintMarker._snapped) {
          const latlng = this._centerMarker.getLatLng();
          const secondLatLng = this._hintMarker.getLatLng();
          const distance2 = this._distanceCalculation(latlng, secondLatLng);
          if (!this._layerGroup.hasLayer(this._centerMarker)) {
          } else if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
            this._hintMarker.setLatLng(this._hintMarker._orgLatLng);
          } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
            this._hintMarker.setLatLng(this._hintMarker._orgLatLng);
          }
        }
        this._hintMarker.setLatLng(this._getNewDestinationOfHintMarker());
      }
    },
    setStyle() {
      const templineStyle = {};
      L.extend(templineStyle, this.options.templineStyle);
      if (this.options[this._editableOption]) {
        templineStyle.radius = 0;
      }
      this._layer?.setStyle(templineStyle);
      this._hintline?.setStyle(this.options.hintlineStyle);
    },
    _distanceCalculation(A, B3) {
      return this._map.project(A).distanceTo(this._map.project(B3));
    }
  });

  // src/js/Draw/L.PM.Draw.Circle.ts
  L_PM_Draw_default.Circle = L_PM_Draw_default.CircleMarker.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Circle";
      this.toolbarButtonName = "drawCircle";
      this._BaseCircleClass = L.Circle;
      this._minRadiusOption = "minRadiusCircle";
      this._maxRadiusOption = "maxRadiusCircle";
      this._editableOption = "resizeableCircle";
      this._defaultRadius = 100;
    },
    _extendingEnable() {
    },
    _extendingDisable() {
    },
    _extendingCreateMarker() {
    },
    isRelevantMarker() {
    },
    _getMinDistanceInMeter() {
      return this.options[this._minRadiusOption];
    },
    _getMaxDistanceInMeter() {
      return this.options[this._maxRadiusOption];
    },
    _distanceCalculation(A, B3) {
      return this._map.distance(A, B3);
    }
  });

  // node_modules/.pnpm/tinyqueue@2.0.3/node_modules/tinyqueue/index.js
  var TinyQueue = class {
    constructor(data = [], compare2 = defaultCompare) {
      this.data = data;
      this.length = this.data.length;
      this.compare = compare2;
      if (this.length > 0) {
        for (let i = (this.length >> 1) - 1; i >= 0; i--) this._down(i);
      }
    }
    push(item) {
      this.data.push(item);
      this.length++;
      this._up(this.length - 1);
    }
    pop() {
      if (this.length === 0) return void 0;
      const top = this.data[0];
      const bottom = this.data.pop();
      this.length--;
      if (this.length > 0) {
        this.data[0] = bottom;
        this._down(0);
      }
      return top;
    }
    peek() {
      return this.data[0];
    }
    _up(pos) {
      const { data, compare: compare2 } = this;
      const item = data[pos];
      while (pos > 0) {
        const parent = pos - 1 >> 1;
        const current = data[parent];
        if (compare2(item, current) >= 0) break;
        data[pos] = current;
        pos = parent;
      }
      data[pos] = item;
    }
    _down(pos) {
      const { data, compare: compare2 } = this;
      const halfLength = this.length >> 1;
      const item = data[pos];
      while (pos < halfLength) {
        let left = (pos << 1) + 1;
        let best = data[left];
        const right = left + 1;
        if (right < this.length && compare2(data[right], best) < 0) {
          left = right;
          best = data[right];
        }
        if (compare2(best, item) >= 0) break;
        data[pos] = best;
        pos = left;
      }
      data[pos] = item;
    }
  };
  function defaultCompare(a, b) {
    return a < b ? -1 : a > b ? 1 : 0;
  }

  // node_modules/.pnpm/robust-predicates@2.0.4/node_modules/robust-predicates/esm/util.js
  var epsilon = 11102230246251565e-32;
  var splitter = 134217729;
  var resulterrbound = (3 + 8 * epsilon) * epsilon;
  function sum(elen, e, flen, f, h) {
    let Q, Qnew, hh, bvirt;
    let enow = e[0];
    let fnow = f[0];
    let eindex = 0;
    let findex = 0;
    if (fnow > enow === fnow > -enow) {
      Q = enow;
      enow = e[++eindex];
    } else {
      Q = fnow;
      fnow = f[++findex];
    }
    let hindex = 0;
    if (eindex < elen && findex < flen) {
      if (fnow > enow === fnow > -enow) {
        Qnew = enow + Q;
        hh = Q - (Qnew - enow);
        enow = e[++eindex];
      } else {
        Qnew = fnow + Q;
        hh = Q - (Qnew - fnow);
        fnow = f[++findex];
      }
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
      while (eindex < elen && findex < flen) {
        if (fnow > enow === fnow > -enow) {
          Qnew = Q + enow;
          bvirt = Qnew - Q;
          hh = Q - (Qnew - bvirt) + (enow - bvirt);
          enow = e[++eindex];
        } else {
          Qnew = Q + fnow;
          bvirt = Qnew - Q;
          hh = Q - (Qnew - bvirt) + (fnow - bvirt);
          fnow = f[++findex];
        }
        Q = Qnew;
        if (hh !== 0) {
          h[hindex++] = hh;
        }
      }
    }
    while (eindex < elen) {
      Qnew = Q + enow;
      bvirt = Qnew - Q;
      hh = Q - (Qnew - bvirt) + (enow - bvirt);
      enow = e[++eindex];
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
    }
    while (findex < flen) {
      Qnew = Q + fnow;
      bvirt = Qnew - Q;
      hh = Q - (Qnew - bvirt) + (fnow - bvirt);
      fnow = f[++findex];
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
    }
    if (Q !== 0 || hindex === 0) {
      h[hindex++] = Q;
    }
    return hindex;
  }
  function estimate(elen, e) {
    let Q = e[0];
    for (let i = 1; i < elen; i++) Q += e[i];
    return Q;
  }
  function vec(n) {
    return new Float64Array(n);
  }

  // node_modules/.pnpm/robust-predicates@2.0.4/node_modules/robust-predicates/esm/orient2d.js
  var ccwerrboundA = (3 + 16 * epsilon) * epsilon;
  var ccwerrboundB = (2 + 12 * epsilon) * epsilon;
  var ccwerrboundC = (9 + 64 * epsilon) * epsilon * epsilon;
  var B = vec(4);
  var C1 = vec(8);
  var C2 = vec(12);
  var D = vec(16);
  var u = vec(4);
  function orient2dadapt(ax, ay, bx, by, cx, cy, detsum) {
    let acxtail, acytail, bcxtail, bcytail;
    let bvirt, c, ahi, alo, bhi, blo, _i, _j, _0, s1, s0, t1, t0, u32;
    const acx = ax - cx;
    const bcx = bx - cx;
    const acy = ay - cy;
    const bcy = by - cy;
    s1 = acx * bcy;
    c = splitter * acx;
    ahi = c - (c - acx);
    alo = acx - ahi;
    c = splitter * bcy;
    bhi = c - (c - bcy);
    blo = bcy - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acy * bcx;
    c = splitter * acy;
    ahi = c - (c - acy);
    alo = acy - ahi;
    c = splitter * bcx;
    bhi = c - (c - bcx);
    blo = bcx - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    B[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    B[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    B[2] = _j - (u32 - bvirt) + (_i - bvirt);
    B[3] = u32;
    let det = estimate(4, B);
    let errbound = ccwerrboundB * detsum;
    if (det >= errbound || -det >= errbound) {
      return det;
    }
    bvirt = ax - acx;
    acxtail = ax - (acx + bvirt) + (bvirt - cx);
    bvirt = bx - bcx;
    bcxtail = bx - (bcx + bvirt) + (bvirt - cx);
    bvirt = ay - acy;
    acytail = ay - (acy + bvirt) + (bvirt - cy);
    bvirt = by - bcy;
    bcytail = by - (bcy + bvirt) + (bvirt - cy);
    if (acxtail === 0 && acytail === 0 && bcxtail === 0 && bcytail === 0) {
      return det;
    }
    errbound = ccwerrboundC * detsum + resulterrbound * Math.abs(det);
    det += acx * bcytail + bcy * acxtail - (acy * bcxtail + bcx * acytail);
    if (det >= errbound || -det >= errbound) return det;
    s1 = acxtail * bcy;
    c = splitter * acxtail;
    ahi = c - (c - acxtail);
    alo = acxtail - ahi;
    c = splitter * bcy;
    bhi = c - (c - bcy);
    blo = bcy - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acytail * bcx;
    c = splitter * acytail;
    ahi = c - (c - acytail);
    alo = acytail - ahi;
    c = splitter * bcx;
    bhi = c - (c - bcx);
    blo = bcx - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u[3] = u32;
    const C1len = sum(4, B, 4, u, C1);
    s1 = acx * bcytail;
    c = splitter * acx;
    ahi = c - (c - acx);
    alo = acx - ahi;
    c = splitter * bcytail;
    bhi = c - (c - bcytail);
    blo = bcytail - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acy * bcxtail;
    c = splitter * acy;
    ahi = c - (c - acy);
    alo = acy - ahi;
    c = splitter * bcxtail;
    bhi = c - (c - bcxtail);
    blo = bcxtail - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u[3] = u32;
    const C2len = sum(C1len, C1, 4, u, C2);
    s1 = acxtail * bcytail;
    c = splitter * acxtail;
    ahi = c - (c - acxtail);
    alo = acxtail - ahi;
    c = splitter * bcytail;
    bhi = c - (c - bcytail);
    blo = bcytail - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acytail * bcxtail;
    c = splitter * acytail;
    ahi = c - (c - acytail);
    alo = acytail - ahi;
    c = splitter * bcxtail;
    bhi = c - (c - bcxtail);
    blo = bcxtail - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u[3] = u32;
    const Dlen = sum(C2len, C2, 4, u, D);
    return D[Dlen - 1];
  }
  function orient2d(ax, ay, bx, by, cx, cy) {
    const detleft = (ay - cy) * (bx - cx);
    const detright = (ax - cx) * (by - cy);
    const det = detleft - detright;
    if (detleft === 0 || detright === 0 || detleft > 0 !== detright > 0) return det;
    const detsum = Math.abs(detleft + detright);
    if (Math.abs(det) >= ccwerrboundA * detsum) return det;
    return -orient2dadapt(ax, ay, bx, by, cx, cy, detsum);
  }

  // node_modules/.pnpm/robust-predicates@2.0.4/node_modules/robust-predicates/esm/orient3d.js
  var o3derrboundA = (7 + 56 * epsilon) * epsilon;
  var o3derrboundB = (3 + 28 * epsilon) * epsilon;
  var o3derrboundC = (26 + 288 * epsilon) * epsilon * epsilon;
  var bc = vec(4);
  var ca = vec(4);
  var ab = vec(4);
  var at_b = vec(4);
  var at_c = vec(4);
  var bt_c = vec(4);
  var bt_a = vec(4);
  var ct_a = vec(4);
  var ct_b = vec(4);
  var bct = vec(8);
  var cat = vec(8);
  var abt = vec(8);
  var u2 = vec(4);
  var _8 = vec(8);
  var _8b = vec(8);
  var _16 = vec(8);
  var _12 = vec(12);
  var fin = vec(192);
  var fin2 = vec(192);

  // node_modules/.pnpm/robust-predicates@2.0.4/node_modules/robust-predicates/esm/incircle.js
  var iccerrboundA = (10 + 96 * epsilon) * epsilon;
  var iccerrboundB = (4 + 48 * epsilon) * epsilon;
  var iccerrboundC = (44 + 576 * epsilon) * epsilon * epsilon;
  var bc2 = vec(4);
  var ca2 = vec(4);
  var ab2 = vec(4);
  var aa = vec(4);
  var bb = vec(4);
  var cc = vec(4);
  var u3 = vec(4);
  var v = vec(4);
  var axtbc = vec(8);
  var aytbc = vec(8);
  var bxtca = vec(8);
  var bytca = vec(8);
  var cxtab = vec(8);
  var cytab = vec(8);
  var abt2 = vec(8);
  var bct2 = vec(8);
  var cat2 = vec(8);
  var abtt = vec(4);
  var bctt = vec(4);
  var catt = vec(4);
  var _82 = vec(8);
  var _162 = vec(16);
  var _16b = vec(16);
  var _16c = vec(16);
  var _32 = vec(32);
  var _32b = vec(32);
  var _48 = vec(48);
  var _64 = vec(64);
  var fin3 = vec(1152);
  var fin22 = vec(1152);

  // node_modules/.pnpm/robust-predicates@2.0.4/node_modules/robust-predicates/esm/insphere.js
  var isperrboundA = (16 + 224 * epsilon) * epsilon;
  var isperrboundB = (5 + 72 * epsilon) * epsilon;
  var isperrboundC = (71 + 1408 * epsilon) * epsilon * epsilon;
  var ab3 = vec(4);
  var bc3 = vec(4);
  var cd = vec(4);
  var de = vec(4);
  var ea = vec(4);
  var ac = vec(4);
  var bd = vec(4);
  var ce = vec(4);
  var da = vec(4);
  var eb = vec(4);
  var abc = vec(24);
  var bcd = vec(24);
  var cde = vec(24);
  var dea = vec(24);
  var eab = vec(24);
  var abd = vec(24);
  var bce = vec(24);
  var cda = vec(24);
  var deb = vec(24);
  var eac = vec(24);
  var adet = vec(1152);
  var bdet = vec(1152);
  var cdet = vec(1152);
  var ddet = vec(1152);
  var edet = vec(1152);
  var abdet = vec(2304);
  var cddet = vec(2304);
  var cdedet = vec(3456);
  var deter = vec(5760);
  var _83 = vec(8);
  var _8b2 = vec(8);
  var _8c = vec(8);
  var _163 = vec(16);
  var _24 = vec(24);
  var _482 = vec(48);
  var _48b = vec(48);
  var _96 = vec(96);
  var _192 = vec(192);
  var _384x = vec(384);
  var _384y = vec(384);
  var _384z = vec(384);
  var _768 = vec(768);
  var xdet = vec(96);
  var ydet = vec(96);
  var zdet = vec(96);
  var fin4 = vec(1152);

  // node_modules/.pnpm/@turf+line-intersect@7.4.0/node_modules/@turf/line-intersect/dist/esm/index.js
  function sweeplineIntersections(geojson, ignoreSelfIntersections) {
    const eventQueue = new TinyQueue([], checkWhichEventIsLeft);
    fillEventQueue(geojson, eventQueue);
    return runCheck(eventQueue, ignoreSelfIntersections);
  }
  function checkWhichEventIsLeft(e1, e2) {
    if (e1.p.x > e2.p.x) return 1;
    if (e1.p.x < e2.p.x) return -1;
    if (e1.p.x === e2.p.x && (e1.featureId !== e2.featureId || e1.ringId !== e2.ringId)) {
      if (e1.isLeftEndpoint && !e2.isLeftEndpoint) return -1;
    }
    if (e1.p.y !== e2.p.y) return e1.p.y > e2.p.y ? 1 : -1;
    return 1;
  }
  function checkWhichSegmentHasRightEndpointFirst(seg1, seg2) {
    if (seg1.rightSweepEvent.p.x > seg2.rightSweepEvent.p.x) return 1;
    if (seg1.rightSweepEvent.p.x < seg2.rightSweepEvent.p.x) return -1;
    if (seg1.rightSweepEvent.p.y !== seg2.rightSweepEvent.p.y) {
      return seg1.rightSweepEvent.p.y < seg2.rightSweepEvent.p.y ? 1 : -1;
    }
    return 1;
  }
  function fillEventQueue(geojson, eventQueue) {
    if (geojson.type === "FeatureCollection") {
      const features = geojson.features;
      for (let i = 0; i < features.length; i++) {
        processFeature(features[i], eventQueue);
      }
    } else {
      processFeature(geojson, eventQueue);
    }
  }
  var featureId = 0;
  var ringId = 0;
  var eventId = 0;
  function processFeature(featureOrGeometry, eventQueue) {
    const geom = featureOrGeometry.type === "Feature" ? featureOrGeometry.geometry : featureOrGeometry;
    let coords = geom.coordinates;
    if (geom.type === "Polygon" || geom.type === "MultiLineString")
      coords = [coords];
    if (geom.type === "LineString") coords = [[coords]];
    for (let i = 0; i < coords.length; i++) {
      for (let ii = 0; ii < coords[i].length; ii++) {
        let currentP = coords[i][ii][0];
        let nextP = null;
        ringId = ringId + 1;
        for (let iii = 0; iii < coords[i][ii].length - 1; iii++) {
          nextP = coords[i][ii][iii + 1];
          const e1 = new Event(currentP, featureId, ringId, eventId);
          const e2 = new Event(nextP, featureId, ringId, eventId + 1);
          e1.otherEvent = e2;
          e2.otherEvent = e1;
          if (checkWhichEventIsLeft(e1, e2) > 0) {
            e2.isLeftEndpoint = true;
            e1.isLeftEndpoint = false;
          } else {
            e1.isLeftEndpoint = true;
            e2.isLeftEndpoint = false;
          }
          eventQueue.push(e1);
          eventQueue.push(e2);
          currentP = nextP;
          eventId = eventId + 1;
        }
      }
    }
    featureId = featureId + 1;
  }
  var Event = class {
    constructor(p, featureId2, ringId2, eventId2) {
      this.p = {
        x: p[0],
        y: p[1]
      };
      this.featureId = featureId2;
      this.ringId = ringId2;
      this.eventId = eventId2;
      this.otherEvent = null;
      this.isLeftEndpoint = null;
    }
    isSamePoint(eventToCheck) {
      return this.p.x === eventToCheck.p.x && this.p.y === eventToCheck.p.y;
    }
    asNewXY() {
      return [this.p.x, this.p.y];
    }
  };
  function runCheck(eventQueue, ignoreSelfIntersections = false) {
    const intersectionPoints = [];
    const outQueue = new TinyQueue([], checkWhichSegmentHasRightEndpointFirst);
    while (eventQueue.length) {
      const event = eventQueue.pop();
      if (event.isLeftEndpoint) {
        const segment = new Segment(event);
        for (let i = 0; i < outQueue.data.length; i++) {
          const otherSeg = outQueue.data[i];
          if (ignoreSelfIntersections) {
            if (otherSeg.leftSweepEvent.featureId === event.featureId) continue;
          }
          const intersection3 = testSegmentIntersect(segment, otherSeg);
          if (intersection3 !== false) intersectionPoints.push(intersection3);
        }
        outQueue.push(segment);
      } else if (event.isLeftEndpoint === false) {
        outQueue.pop();
      }
    }
    return intersectionPoints;
  }
  var Segment = class {
    /** @param event must have otherEvent non-null */
    constructor(event) {
      this.leftSweepEvent = event;
      this.rightSweepEvent = event.otherEvent;
    }
  };
  function testSegmentIntersect(seg1, seg2) {
    if (seg1 === null || seg2 === null) return false;
    const x1 = seg1.leftSweepEvent.p.x;
    const y1 = seg1.leftSweepEvent.p.y;
    const x2 = seg1.rightSweepEvent.p.x;
    const y2 = seg1.rightSweepEvent.p.y;
    const x3 = seg2.leftSweepEvent.p.x;
    const y3 = seg2.leftSweepEvent.p.y;
    const x4 = seg2.rightSweepEvent.p.x;
    const y4 = seg2.rightSweepEvent.p.y;
    const score1 = orient2d(x1, y1, x2, y2, x3, y3);
    const score2 = orient2d(x1, y1, x2, y2, x4, y4);
    if (score1 > 0 && score2 > 0) return false;
    else if (score1 < 0 && score2 < 0) return false;
    if (seg1.leftSweepEvent.ringId === seg2.leftSweepEvent.ringId) {
      if (seg1.rightSweepEvent.isSamePoint(seg2.leftSweepEvent) || seg1.rightSweepEvent.isSamePoint(seg2.rightSweepEvent) || seg1.leftSweepEvent.isSamePoint(seg2.leftSweepEvent) || seg1.leftSweepEvent.isSamePoint(seg2.rightSweepEvent))
        return false;
    } else {
      if (seg1.rightSweepEvent.isSamePoint(seg2.leftSweepEvent))
        return seg2.leftSweepEvent.asNewXY();
      if (seg1.rightSweepEvent.isSamePoint(seg2.rightSweepEvent))
        return seg2.rightSweepEvent.asNewXY();
      if (seg1.leftSweepEvent.isSamePoint(seg2.leftSweepEvent))
        return seg2.leftSweepEvent.asNewXY();
      if (seg1.leftSweepEvent.isSamePoint(seg2.rightSweepEvent))
        return seg2.rightSweepEvent.asNewXY();
    }
    const denom = (y4 - y3) * (x2 - x1) - (x4 - x3) * (y2 - y1);
    const numeA = (x4 - x3) * (y1 - y3) - (y4 - y3) * (x1 - x3);
    const numeB = (x2 - x1) * (y1 - y3) - (y2 - y1) * (x1 - x3);
    if (denom === 0) {
      if (numeA === 0 && numeB === 0) return false;
      return false;
    }
    const uA = numeA / denom;
    const uB = numeB / denom;
    if (uA >= 0 && uA <= 1 && uB >= 0 && uB <= 1) {
      const x = x1 + uA * (x2 - x1);
      const y = y1 + uA * (y2 - y1);
      return [x, y];
    }
    return false;
  }
  function lineIntersect(line1, line2, options = {}) {
    const { removeDuplicates = true, ignoreSelfIntersections = true } = options;
    let features = [];
    if (line1.type === "FeatureCollection")
      features = features.concat(line1.features);
    else if (line1.type === "Feature") features.push(line1);
    else if (line1.type === "LineString" || line1.type === "Polygon" || line1.type === "MultiLineString" || line1.type === "MultiPolygon") {
      features.push(feature(line1));
    }
    if (line2.type === "FeatureCollection")
      features = features.concat(line2.features);
    else if (line2.type === "Feature") features.push(line2);
    else if (line2.type === "LineString" || line2.type === "Polygon" || line2.type === "MultiLineString" || line2.type === "MultiPolygon") {
      features.push(feature(line2));
    }
    const intersections = sweeplineIntersections(
      featureCollection(features),
      ignoreSelfIntersections
    );
    let results = [];
    if (removeDuplicates) {
      const unique = {};
      intersections.forEach((intersection3) => {
        const key = intersection3.join(",");
        if (!unique[key]) {
          unique[key] = true;
          results.push(intersection3);
        }
      });
    } else {
      results = intersections;
    }
    return featureCollection(results.map((r) => point(r)));
  }
  var index_default2 = lineIntersect;

  // node_modules/.pnpm/@turf+geojson-rbush@7.4.0/node_modules/@turf/geojson-rbush/dist/esm/index.js
  var import_rbush = __toESM(require_rbush_min(), 1);

  // node_modules/.pnpm/@turf+meta@7.4.0/node_modules/@turf/meta/dist/esm/index.js
  function coordEach(geojson, callback, excludeWrapCoord) {
    if (geojson === null) return;
    var j, k, l, geometry, stopG, coords, geometryMaybeCollection, wrapShrink = 0, coordIndex = 0, isGeometryCollection, type = geojson.type, isFeatureCollection = type === "FeatureCollection", isFeature = type === "Feature", stop = isFeatureCollection ? geojson.features.length : 1;
    for (var featureIndex = 0; featureIndex < stop; featureIndex++) {
      geometryMaybeCollection = isFeatureCollection ? (
        // @ts-expect-error: Known type conflict
        geojson.features[featureIndex].geometry
      ) : isFeature ? (
        // @ts-expect-error: Known type conflict
        geojson.geometry
      ) : geojson;
      isGeometryCollection = geometryMaybeCollection ? geometryMaybeCollection.type === "GeometryCollection" : false;
      stopG = isGeometryCollection ? geometryMaybeCollection.geometries.length : 1;
      for (var geomIndex = 0; geomIndex < stopG; geomIndex++) {
        var multiFeatureIndex = 0;
        var geometryIndex = 0;
        geometry = isGeometryCollection ? geometryMaybeCollection.geometries[geomIndex] : geometryMaybeCollection;
        if (geometry === null) continue;
        coords = geometry.coordinates;
        var geomType = geometry.type;
        wrapShrink = excludeWrapCoord && (geomType === "Polygon" || geomType === "MultiPolygon") ? 1 : 0;
        switch (geomType) {
          case null:
            break;
          case "Point":
            if (
              // @ts-expect-error: Known type conflict
              callback(
                coords,
                coordIndex,
                featureIndex,
                multiFeatureIndex,
                geometryIndex
              ) === false
            )
              return false;
            coordIndex++;
            multiFeatureIndex++;
            break;
          case "LineString":
          case "MultiPoint":
            for (j = 0; j < coords.length; j++) {
              if (
                // @ts-expect-error: Known type conflict
                callback(
                  coords[j],
                  coordIndex,
                  featureIndex,
                  multiFeatureIndex,
                  geometryIndex
                ) === false
              )
                return false;
              coordIndex++;
              if (geomType === "MultiPoint") multiFeatureIndex++;
            }
            if (geomType === "LineString") multiFeatureIndex++;
            break;
          case "Polygon":
          case "MultiLineString":
            for (j = 0; j < coords.length; j++) {
              for (k = 0; k < coords[j].length - wrapShrink; k++) {
                if (
                  // @ts-expect-error: Known type conflict
                  callback(
                    coords[j][k],
                    coordIndex,
                    featureIndex,
                    multiFeatureIndex,
                    geometryIndex
                  ) === false
                )
                  return false;
                coordIndex++;
              }
              if (geomType === "MultiLineString") multiFeatureIndex++;
              if (geomType === "Polygon") geometryIndex++;
            }
            if (geomType === "Polygon") multiFeatureIndex++;
            break;
          case "MultiPolygon":
            for (j = 0; j < coords.length; j++) {
              geometryIndex = 0;
              for (k = 0; k < coords[j].length; k++) {
                for (l = 0; l < coords[j][k].length - wrapShrink; l++) {
                  if (
                    // @ts-expect-error: Known type conflict
                    callback(
                      coords[j][k][l],
                      coordIndex,
                      featureIndex,
                      multiFeatureIndex,
                      geometryIndex
                    ) === false
                  )
                    return false;
                  coordIndex++;
                }
                geometryIndex++;
              }
              multiFeatureIndex++;
            }
            break;
          case "GeometryCollection":
            for (j = 0; j < geometry.geometries.length; j++)
              if (
                // @ts-expect-error: Known type conflict
                coordEach(geometry.geometries[j], callback, excludeWrapCoord) === false
              )
                return false;
            break;
          default:
            throw new Error("Unknown Geometry Type");
        }
      }
    }
  }
  function featureEach(geojson, callback) {
    if (geojson.type === "Feature") {
      callback(geojson, 0);
    } else if (geojson.type === "FeatureCollection") {
      for (var i = 0; i < geojson.features.length; i++) {
        if (callback(geojson.features[i], i) === false) break;
      }
    }
  }
  function featureReduce(geojson, callback, initialValue) {
    var previousValue = initialValue;
    featureEach(geojson, function(currentFeature, featureIndex) {
      if (featureIndex === 0 && initialValue === void 0)
        previousValue = currentFeature;
      else previousValue = callback(previousValue, currentFeature, featureIndex);
    });
    return previousValue;
  }
  function geomEach(geojson, callback) {
    var i, j, g, geometry, stopG, geometryMaybeCollection, isGeometryCollection, featureProperties, featureBBox, featureId2, featureIndex = 0, isFeatureCollection = geojson.type === "FeatureCollection", isFeature = geojson.type === "Feature", stop = isFeatureCollection ? geojson.features.length : 1;
    for (i = 0; i < stop; i++) {
      geometryMaybeCollection = isFeatureCollection ? (
        // @ts-expect-error: Known type conflict
        geojson.features[i].geometry
      ) : isFeature ? (
        // @ts-expect-error: Known type conflict
        geojson.geometry
      ) : geojson;
      featureProperties = isFeatureCollection ? (
        // @ts-expect-error: Known type conflict
        geojson.features[i].properties
      ) : isFeature ? (
        // @ts-expect-error: Known type conflict
        geojson.properties
      ) : {};
      featureBBox = isFeatureCollection ? (
        // @ts-expect-error: Known type conflict
        geojson.features[i].bbox
      ) : isFeature ? (
        // @ts-expect-error: Known type conflict
        geojson.bbox
      ) : void 0;
      featureId2 = isFeatureCollection ? (
        // @ts-expect-error: Known type conflict
        geojson.features[i].id
      ) : isFeature ? (
        // @ts-expect-error: Known type conflict
        geojson.id
      ) : void 0;
      isGeometryCollection = geometryMaybeCollection ? geometryMaybeCollection.type === "GeometryCollection" : false;
      stopG = isGeometryCollection ? geometryMaybeCollection.geometries.length : 1;
      for (g = 0; g < stopG; g++) {
        geometry = isGeometryCollection ? geometryMaybeCollection.geometries[g] : geometryMaybeCollection;
        if (geometry === null) {
          if (
            // @ts-expect-error: Known type conflict
            callback(
              // @ts-expect-error: Known type conflict
              null,
              featureIndex,
              featureProperties,
              featureBBox,
              featureId2
            ) === false
          )
            return false;
          continue;
        }
        switch (geometry.type) {
          case "Point":
          case "LineString":
          case "MultiPoint":
          case "Polygon":
          case "MultiLineString":
          case "MultiPolygon": {
            if (
              // @ts-expect-error: Known type conflict
              callback(
                geometry,
                featureIndex,
                featureProperties,
                featureBBox,
                featureId2
              ) === false
            )
              return false;
            break;
          }
          case "GeometryCollection": {
            for (j = 0; j < geometry.geometries.length; j++) {
              if (
                // @ts-expect-error: Known type conflict
                callback(
                  geometry.geometries[j],
                  featureIndex,
                  featureProperties,
                  featureBBox,
                  featureId2
                ) === false
              )
                return false;
            }
            break;
          }
          default:
            throw new Error("Unknown Geometry Type");
        }
      }
      featureIndex++;
    }
  }
  function flattenEach(geojson, callback) {
    geomEach(geojson, function(geometry, featureIndex, properties, bbox3, id) {
      var type = geometry === null ? null : geometry.type;
      switch (type) {
        case null:
        case "Point":
        case "LineString":
        case "Polygon":
          if (
            // @ts-expect-error: Known type conflict
            callback(
              feature(geometry, properties, { bbox: bbox3, id }),
              featureIndex,
              0
            ) === false
          )
            return false;
          return;
      }
      var geomType;
      switch (type) {
        case "MultiPoint":
          geomType = "Point";
          break;
        case "MultiLineString":
          geomType = "LineString";
          break;
        case "MultiPolygon":
          geomType = "Polygon";
          break;
      }
      for (
        var multiFeatureIndex = 0;
        // @ts-expect-error: Known type conflict
        multiFeatureIndex < geometry.coordinates.length;
        multiFeatureIndex++
      ) {
        var coordinate = geometry.coordinates[multiFeatureIndex];
        var geom = {
          type: geomType,
          coordinates: coordinate
        };
        if (
          // @ts-expect-error: Known type conflict
          callback(feature(geom, properties), featureIndex, multiFeatureIndex) === false
        )
          return false;
      }
    });
  }

  // node_modules/.pnpm/@turf+bbox@7.4.0/node_modules/@turf/bbox/dist/esm/index.js
  function bbox(geojson, options = {}) {
    if (geojson.bbox != null && true !== options.recompute) {
      return geojson.bbox;
    }
    const result = [Infinity, Infinity, -Infinity, -Infinity];
    coordEach(geojson, (coord) => {
      if (result[0] > coord[0]) {
        result[0] = coord[0];
      }
      if (result[1] > coord[1]) {
        result[1] = coord[1];
      }
      if (result[2] < coord[0]) {
        result[2] = coord[0];
      }
      if (result[3] < coord[1]) {
        result[3] = coord[1];
      }
    });
    return result;
  }

  // node_modules/.pnpm/@turf+geojson-rbush@7.4.0/node_modules/@turf/geojson-rbush/dist/esm/index.js
  function toBBox(geojson) {
    var bbox3;
    if (geojson.bbox) bbox3 = geojson.bbox;
    else if (Array.isArray(geojson) && geojson.length === 4) bbox3 = geojson;
    else if (Array.isArray(geojson) && geojson.length === 6)
      bbox3 = [geojson[0], geojson[1], geojson[3], geojson[4]];
    else if (geojson.type === "Feature") bbox3 = bbox(geojson);
    else if (geojson.type === "FeatureCollection") bbox3 = bbox(geojson);
    else throw new Error("invalid geojson");
    return {
      minX: bbox3[0],
      minY: bbox3[1],
      maxX: bbox3[2],
      maxY: bbox3[3]
    };
  }
  var RBush = class {
    constructor(maxEntries = 9) {
      this.tree = new import_rbush.default(maxEntries);
      this.tree.toBBox = toBBox;
    }
    /**
     * [insert](https://github.com/mourner/rbush#data-format)
     *
     * @memberof rbush
     * @param {Feature} feature insert single GeoJSON Feature
     * @returns {RBush} GeoJSON RBush
     * @example
     * var poly = turf.polygon([[[-78, 41], [-67, 41], [-67, 48], [-78, 48], [-78, 41]]]);
     * tree.insert(poly)
     */
    insert(feature3) {
      if (feature3.type !== "Feature") throw new Error("invalid feature");
      feature3.bbox = feature3.bbox ? feature3.bbox : bbox(feature3);
      this.tree.insert(feature3);
      return this;
    }
    /**
     * [load](https://github.com/mourner/rbush#bulk-inserting-data)
     *
     * @memberof rbush
     * @param {FeatureCollection|Array<Feature>} features load entire GeoJSON FeatureCollection
     * @returns {RBush} GeoJSON RBush
     * @example
     * var polys = turf.polygons([
     *     [[[-78, 41], [-67, 41], [-67, 48], [-78, 48], [-78, 41]]],
     *     [[[-93, 32], [-83, 32], [-83, 39], [-93, 39], [-93, 32]]]
     * ]);
     * tree.load(polys);
     */
    load(features) {
      var load = [];
      if (Array.isArray(features)) {
        features.forEach(function(feature3) {
          if (feature3.type !== "Feature") throw new Error("invalid features");
          feature3.bbox = feature3.bbox ? feature3.bbox : bbox(feature3);
          load.push(feature3);
        });
      } else {
        featureEach(features, function(feature3) {
          if (feature3.type !== "Feature") throw new Error("invalid features");
          feature3.bbox = feature3.bbox ? feature3.bbox : bbox(feature3);
          load.push(feature3);
        });
      }
      this.tree.load(load);
      return this;
    }
    /**
     * [remove](https://github.com/mourner/rbush#removing-data)
     *
     * @memberof rbush
     * @param {Feature} feature remove single GeoJSON Feature
     * @param {Function} equals Pass a custom equals function to compare by value for removal.
     * @returns {RBush} GeoJSON RBush
     * @example
     * var poly = turf.polygon([[[-78, 41], [-67, 41], [-67, 48], [-78, 48], [-78, 41]]]);
     *
     * tree.remove(poly);
     */
    remove(feature3, equals) {
      if (feature3.type !== "Feature") throw new Error("invalid feature");
      feature3.bbox = feature3.bbox ? feature3.bbox : bbox(feature3);
      this.tree.remove(feature3, equals);
      return this;
    }
    /**
     * [clear](https://github.com/mourner/rbush#removing-data)
     *
     * @memberof rbush
     * @returns {RBush} GeoJSON Rbush
     * @example
     * tree.clear()
     */
    clear() {
      this.tree.clear();
      return this;
    }
    /**
     * [search](https://github.com/mourner/rbush#search)
     *
     * @memberof rbush
     * @param {BBox|FeatureCollection|Feature} geojson search with GeoJSON
     * @returns {FeatureCollection} all features that intersects with the given GeoJSON.
     * @example
     * var poly = turf.polygon([[[-78, 41], [-67, 41], [-67, 48], [-78, 48], [-78, 41]]]);
     *
     * tree.search(poly);
     */
    search(geojson) {
      var features = this.tree.search(toBBox(geojson));
      return featureCollection(features);
    }
    /**
     * [collides](https://github.com/mourner/rbush#collisions)
     *
     * @memberof rbush
     * @param {BBox|FeatureCollection|Feature} geojson collides with GeoJSON
     * @returns {boolean} true if there are any items intersecting the given GeoJSON, otherwise false.
     * @example
     * var poly = turf.polygon([[[-78, 41], [-67, 41], [-67, 48], [-78, 48], [-78, 41]]]);
     *
     * tree.collides(poly);
     */
    collides(geojson) {
      return this.tree.collides(toBBox(geojson));
    }
    /**
     * [all](https://github.com/mourner/rbush#search)
     *
     * @memberof rbush
     * @returns {FeatureCollection} all the features in RBush
     * @example
     * tree.all()
     */
    all() {
      const features = this.tree.all();
      return featureCollection(features);
    }
    /**
     * [toJSON](https://github.com/mourner/rbush#export-and-import)
     *
     * @memberof rbush
     * @returns {any} export data as JSON object
     * @example
     * var exported = tree.toJSON()
     */
    toJSON() {
      return this.tree.toJSON();
    }
    /**
     * [fromJSON](https://github.com/mourner/rbush#export-and-import)
     *
     * @memberof rbush
     * @param {any} json import previously exported data
     * @returns {RBush} GeoJSON RBush
     * @example
     * var exported = {
     *   "children": [
     *     {
     *       "type": "Feature",
     *       "geometry": {
     *         "type": "Point",
     *         "coordinates": [110, 50]
     *       },
     *       "properties": {},
     *       "bbox": [110, 50, 110, 50]
     *     }
     *   ],
     *   "height": 1,
     *   "leaf": true,
     *   "minX": 110,
     *   "minY": 50,
     *   "maxX": 110,
     *   "maxY": 50
     * }
     * tree.fromJSON(exported)
     */
    fromJSON(json) {
      this.tree.fromJSON(json);
      return this;
    }
  };
  function geojsonRbush(maxEntries) {
    return new RBush(maxEntries);
  }

  // node_modules/.pnpm/@turf+truncate@7.4.0/node_modules/@turf/truncate/dist/esm/index.js
  function truncate(geojson, options) {
    options = options != null ? options : {};
    if (!isObject(options)) throw new Error("options is invalid");
    var precision2 = options.precision;
    var coordinates = options.coordinates;
    var mutate = options.mutate;
    precision2 = precision2 === void 0 || precision2 === null || isNaN(precision2) ? 6 : precision2;
    coordinates = coordinates === void 0 || coordinates === null || isNaN(coordinates) ? 3 : coordinates;
    if (!geojson) throw new Error("<geojson> is required");
    if (typeof precision2 !== "number")
      throw new Error("<precision> must be a number");
    if (typeof coordinates !== "number")
      throw new Error("<coordinates> must be a number");
    if (mutate === false || mutate === void 0)
      geojson = JSON.parse(JSON.stringify(geojson));
    var factor = Math.pow(10, precision2);
    coordEach(geojson, function(coords) {
      truncateCoords(coords, factor, coordinates);
    });
    return geojson;
  }
  function truncateCoords(coords, factor, coordinates) {
    if (coords.length > coordinates) coords.splice(coordinates, coords.length);
    for (var i = 0; i < coords.length; i++) {
      coords[i] = Math.round(coords[i] * factor) / factor;
    }
    return coords;
  }

  // node_modules/.pnpm/@turf+invariant@7.4.0/node_modules/@turf/invariant/dist/esm/index.js
  function getCoord(coord) {
    if (!coord) {
      throw new Error("coord is required");
    }
    if (!Array.isArray(coord)) {
      if (coord.type === "Feature" && coord.geometry !== null && coord.geometry.type === "Point") {
        return [...coord.geometry.coordinates];
      }
      if (coord.type === "Point") {
        return [...coord.coordinates];
      }
    }
    if (Array.isArray(coord) && coord.length >= 2 && !Array.isArray(coord[0]) && !Array.isArray(coord[1])) {
      return [...coord];
    }
    throw new Error("coord must be GeoJSON Point or an Array of numbers");
  }
  function getCoords(coords) {
    if (Array.isArray(coords)) {
      return coords;
    }
    if (coords.type === "Feature") {
      if (coords.geometry !== null) {
        return coords.geometry.coordinates;
      }
    } else {
      if (coords.coordinates) {
        return coords.coordinates;
      }
    }
    throw new Error(
      "coords must be GeoJSON Feature, Geometry Object or an Array"
    );
  }
  function getGeom(geojson) {
    if (geojson.type === "Feature") {
      return geojson.geometry;
    }
    return geojson;
  }
  function getType(geojson, _name) {
    if (geojson.type === "FeatureCollection") {
      return "FeatureCollection";
    }
    if (geojson.type === "GeometryCollection") {
      return "GeometryCollection";
    }
    if (geojson.type === "Feature" && geojson.geometry !== null) {
      return geojson.geometry.type;
    }
    return geojson.type;
  }

  // node_modules/.pnpm/@turf+line-segment@7.4.0/node_modules/@turf/line-segment/dist/esm/index.js
  function lineSegment(geojson) {
    if (!geojson) {
      throw new Error("geojson is required");
    }
    const results = [];
    flattenEach(geojson, (feature3) => {
      lineSegmentFeature(feature3, results);
    });
    return featureCollection(results);
  }
  function lineSegmentFeature(geojson, results) {
    let coords = [];
    const geometry = geojson.geometry;
    if (geometry !== null) {
      switch (geometry.type) {
        case "Polygon":
          coords = getCoords(geometry);
          break;
        case "LineString":
          coords = [getCoords(geometry)];
      }
      coords.forEach((coord) => {
        const segments = createSegments(coord, geojson.properties);
        segments.forEach((segment) => {
          segment.id = results.length;
          results.push(segment);
        });
      });
    }
  }
  function createSegments(coords, properties) {
    const segments = [];
    coords.reduce((previousCoords, currentCoords) => {
      const segment = lineString([previousCoords, currentCoords], properties);
      segment.bbox = bbox2(previousCoords, currentCoords);
      segments.push(segment);
      return currentCoords;
    });
    return segments;
  }
  function bbox2(coords1, coords2) {
    const x1 = coords1[0];
    const y1 = coords1[1];
    const x2 = coords2[0];
    const y2 = coords2[1];
    const west = x1 < x2 ? x1 : x2;
    const south = y1 < y2 ? y1 : y2;
    const east = x1 > x2 ? x1 : x2;
    const north = y1 > y2 ? y1 : y2;
    return [west, south, east, north];
  }

  // node_modules/.pnpm/@turf+distance@7.4.0/node_modules/@turf/distance/dist/esm/index.js
  function distance(from, to, options = {}) {
    var coordinates1 = getCoord(from);
    var coordinates2 = getCoord(to);
    var dLat = degreesToRadians(coordinates2[1] - coordinates1[1]);
    var dLon = degreesToRadians(coordinates2[0] - coordinates1[0]);
    var lat1 = degreesToRadians(coordinates1[1]);
    var lat2 = degreesToRadians(coordinates2[1]);
    var a = Math.pow(Math.sin(dLat / 2), 2) + Math.pow(Math.sin(dLon / 2), 2) * Math.cos(lat1) * Math.cos(lat2);
    return radiansToLength(
      2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)),
      options.units
    );
  }

  // node_modules/.pnpm/@turf+nearest-point-on-line@7.4.0/node_modules/@turf/nearest-point-on-line/dist/esm/index.js
  var __defProp2 = Object.defineProperty;
  var __defProps = Object.defineProperties;
  var __getOwnPropDescs = Object.getOwnPropertyDescriptors;
  var __getOwnPropSymbols = Object.getOwnPropertySymbols;
  var __hasOwnProp2 = Object.prototype.hasOwnProperty;
  var __propIsEnum = Object.prototype.propertyIsEnumerable;
  var __defNormalProp = (obj, key, value) => key in obj ? __defProp2(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
  var __spreadValues = (a, b) => {
    for (var prop in b || (b = {}))
      if (__hasOwnProp2.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    if (__getOwnPropSymbols)
      for (var prop of __getOwnPropSymbols(b)) {
        if (__propIsEnum.call(b, prop))
          __defNormalProp(a, prop, b[prop]);
      }
    return a;
  };
  var __spreadProps = (a, b) => __defProps(a, __getOwnPropDescs(b));
  function nearestPointOnLine(lines, inputPoint, options = {}) {
    if (!lines || !inputPoint) {
      throw new Error("lines and inputPoint are required arguments");
    }
    const inputPos = getCoord(inputPoint);
    let closestPt = point([Infinity, Infinity], {
      lineStringIndex: -1,
      segmentIndex: -1,
      totalDistance: -1,
      lineDistance: -1,
      segmentDistance: -1,
      pointDistance: Infinity,
      // deprecated properties START
      multiFeatureIndex: -1,
      index: -1,
      location: -1,
      dist: Infinity
      // deprecated properties END
    });
    let totalDistance = 0;
    let lineDistance = 0;
    let currentLineStringIndex = -1;
    flattenEach(
      lines,
      function(line, _featureIndex, lineStringIndex) {
        if (currentLineStringIndex !== lineStringIndex) {
          currentLineStringIndex = lineStringIndex;
          lineDistance = 0;
        }
        const coords = getCoords(line);
        for (let i = 0; i < coords.length - 1; i++) {
          const start = point(coords[i]);
          const startPos = getCoord(start);
          const stop = point(coords[i + 1]);
          const stopPos = getCoord(stop);
          const segmentLength = distance(start, stop, options);
          let intersectPos;
          let wasEnd;
          if (stopPos[0] === inputPos[0] && stopPos[1] === inputPos[1]) {
            [intersectPos, wasEnd] = [stopPos, true];
          } else if (startPos[0] === inputPos[0] && startPos[1] === inputPos[1]) {
            [intersectPos, wasEnd] = [startPos, false];
          } else {
            [intersectPos, wasEnd] = nearestPointOnSegment(
              startPos,
              stopPos,
              inputPos
            );
          }
          const pointDistance = distance(inputPoint, intersectPos, options);
          if (pointDistance < closestPt.properties.pointDistance) {
            const segmentDistance = distance(start, intersectPos, options);
            closestPt = point(intersectPos, {
              lineStringIndex,
              // Legacy behaviour where index progresses to next segment # if we
              // went with the end point this iteration.
              segmentIndex: wasEnd ? i + 1 : i,
              totalDistance: totalDistance + segmentDistance,
              lineDistance: lineDistance + segmentDistance,
              segmentDistance,
              pointDistance,
              // deprecated properties START
              multiFeatureIndex: -1,
              index: -1,
              location: -1,
              dist: Infinity
              // deprecated properties END
            });
            closestPt.properties = __spreadProps(__spreadValues({}, closestPt.properties), {
              multiFeatureIndex: closestPt.properties.lineStringIndex,
              index: closestPt.properties.segmentIndex,
              location: closestPt.properties.totalDistance,
              dist: closestPt.properties.pointDistance
              // deprecated properties END
            });
          }
          totalDistance += segmentLength;
          lineDistance += segmentLength;
        }
      }
    );
    return closestPt;
  }
  function dot(v1, v22) {
    const [v1x, v1y, v1z] = v1;
    const [v2x, v2y, v2z] = v22;
    return v1x * v2x + v1y * v2y + v1z * v2z;
  }
  function cross(v1, v22) {
    const [v1x, v1y, v1z] = v1;
    const [v2x, v2y, v2z] = v22;
    return [v1y * v2z - v1z * v2y, v1z * v2x - v1x * v2z, v1x * v2y - v1y * v2x];
  }
  function magnitude(v3) {
    return Math.sqrt(Math.pow(v3[0], 2) + Math.pow(v3[1], 2) + Math.pow(v3[2], 2));
  }
  function normalize(v3) {
    const mag = magnitude(v3);
    return [v3[0] / mag, v3[1] / mag, v3[2] / mag];
  }
  function lngLatToVector(a) {
    const lat = degreesToRadians(a[1]);
    const lng = degreesToRadians(a[0]);
    return [
      Math.cos(lat) * Math.cos(lng),
      Math.cos(lat) * Math.sin(lng),
      Math.sin(lat)
    ];
  }
  function vectorToLngLat(v3) {
    const [x, y, z] = v3;
    const zClamp = Math.min(Math.max(z, -1), 1);
    const lat = radiansToDegrees(Math.asin(zClamp));
    const lng = radiansToDegrees(Math.atan2(y, x));
    return [lng, lat];
  }
  function nearestPointOnSegment(posA, posB, posC) {
    const A = lngLatToVector(posA);
    const B3 = lngLatToVector(posB);
    const C = lngLatToVector(posC);
    const segmentAxis = cross(A, B3);
    if (segmentAxis[0] === 0 && segmentAxis[1] === 0 && segmentAxis[2] === 0) {
      if (dot(A, B3) > 0) {
        return [[...posB], true];
      } else {
        return [[...posC], false];
      }
    }
    const targetAxis = cross(segmentAxis, C);
    if (targetAxis[0] === 0 && targetAxis[1] === 0 && targetAxis[2] === 0) {
      return [[...posB], true];
    }
    const intersectionAxis = cross(targetAxis, segmentAxis);
    const I1 = normalize(intersectionAxis);
    const I2 = [-I1[0], -I1[1], -I1[2]];
    const I = dot(C, I1) > dot(C, I2) ? I1 : I2;
    const segmentAxisNorm = normalize(segmentAxis);
    const cmpAI = dot(cross(A, I), segmentAxisNorm);
    const cmpIB = dot(cross(I, B3), segmentAxisNorm);
    if (cmpAI >= 0 && cmpIB >= 0) {
      return [vectorToLngLat(I), false];
    }
    if (dot(A, C) > dot(B3, C)) {
      return [[...posA], false];
    } else {
      return [[...posB], true];
    }
  }

  // node_modules/.pnpm/@turf+line-split@7.4.0/node_modules/@turf/line-split/dist/esm/index.js
  function lineSplit(line, splitter3) {
    if (!line) throw new Error("line is required");
    if (!splitter3) throw new Error("splitter is required");
    const lineType = getType(line);
    const splitterType = getType(splitter3);
    if (lineType !== "LineString") throw new Error("line must be LineString");
    if (splitterType === "FeatureCollection")
      throw new Error("splitter cannot be a FeatureCollection");
    if (splitterType === "GeometryCollection")
      throw new Error("splitter cannot be a GeometryCollection");
    var truncatedSplitter = truncate(splitter3, { precision: 7 });
    if (line.type !== "Feature") {
      line = feature(line);
    }
    switch (splitterType) {
      case "Point":
        return splitLineWithPoint(
          line,
          truncatedSplitter
        );
      case "MultiPoint":
        return splitLineWithPoints(
          line,
          truncatedSplitter
        );
      case "LineString":
      case "MultiLineString":
      case "Polygon":
      case "MultiPolygon":
        return splitLineWithPoints(
          line,
          lineIntersect(
            line,
            truncatedSplitter,
            {
              ignoreSelfIntersections: true
            }
          )
        );
    }
  }
  function splitLineWithPoints(line, splitter3) {
    var results = [];
    var tree = geojsonRbush();
    flattenEach(
      splitter3,
      // this cast should be unnecessary (and is wrong, it could contain MultiPoints), but is a workaround for bad flattenEach typings
      function(point2) {
        results.forEach(function(feature22, index) {
          feature22.id = index;
        });
        if (!results.length) {
          results = splitLineWithPoint(line, point2).features;
          tree.load(featureCollection(results));
        } else {
          var search = tree.search(point2);
          if (search.features.length) {
            var closestLine = findClosestFeature(point2, search);
            results = results.filter(function(feature22) {
              return feature22.id !== closestLine.id;
            });
            tree.remove(closestLine);
            featureEach(splitLineWithPoint(closestLine, point2), function(line2) {
              results.push(line2);
              tree.insert(line2);
            });
          }
        }
      }
    );
    return featureCollection(results);
  }
  function splitLineWithPoint(line, splitter3) {
    var results = [];
    var startPoint = getCoords(line)[0];
    var endPoint = getCoords(line)[line.geometry.coordinates.length - 1];
    if (pointsEquals(startPoint, getCoord(splitter3)) || pointsEquals(endPoint, getCoord(splitter3)))
      return featureCollection([line]);
    var tree = geojsonRbush();
    var segments = lineSegment(line);
    tree.load(segments);
    var search = tree.search(splitter3);
    if (!search.features.length) return featureCollection([line]);
    var closestSegment = findClosestFeature(splitter3, search);
    var initialValue = [startPoint];
    var lastCoords = featureReduce(
      segments,
      function(previous, current, index) {
        var currentCoords = getCoords(current)[1];
        var splitterCoords = getCoord(splitter3);
        if (index === closestSegment.id) {
          previous.push(splitterCoords);
          results.push(lineString(previous));
          if (pointsEquals(splitterCoords, currentCoords))
            return [splitterCoords];
          return [splitterCoords, currentCoords];
        } else {
          previous.push(currentCoords);
          return previous;
        }
      },
      initialValue
    );
    if (lastCoords.length > 1) {
      results.push(lineString(lastCoords));
    }
    return featureCollection(results);
  }
  function findClosestFeature(point2, lines) {
    if (!lines.features.length) throw new Error("lines must contain features");
    if (lines.features.length === 1) return lines.features[0];
    var closestFeature;
    var closestDistance = Infinity;
    featureEach(lines, function(segment) {
      var pt2 = nearestPointOnLine(segment, point2);
      var dist = pt2.properties.pointDistance;
      if (dist < closestDistance) {
        closestFeature = segment;
        closestDistance = dist;
      }
    });
    return closestFeature;
  }
  function pointsEquals(pt1, pt2) {
    return pt1[0] === pt2[0] && pt1[1] === pt2[1];
  }
  var index_default3 = lineSplit;

  // node_modules/.pnpm/robust-predicates@3.0.3/node_modules/robust-predicates/esm/util.js
  var epsilon2 = 11102230246251565e-32;
  var splitter2 = 134217729;
  var resulterrbound2 = (3 + 8 * epsilon2) * epsilon2;
  function sum2(elen, e, flen, f, h) {
    let Q, Qnew, hh, bvirt;
    let enow = e[0];
    let fnow = f[0];
    let eindex = 0;
    let findex = 0;
    if (fnow > enow === fnow > -enow) {
      Q = enow;
      enow = e[++eindex];
    } else {
      Q = fnow;
      fnow = f[++findex];
    }
    let hindex = 0;
    if (eindex < elen && findex < flen) {
      if (fnow > enow === fnow > -enow) {
        Qnew = enow + Q;
        hh = Q - (Qnew - enow);
        enow = e[++eindex];
      } else {
        Qnew = fnow + Q;
        hh = Q - (Qnew - fnow);
        fnow = f[++findex];
      }
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
      while (eindex < elen && findex < flen) {
        if (fnow > enow === fnow > -enow) {
          Qnew = Q + enow;
          bvirt = Qnew - Q;
          hh = Q - (Qnew - bvirt) + (enow - bvirt);
          enow = e[++eindex];
        } else {
          Qnew = Q + fnow;
          bvirt = Qnew - Q;
          hh = Q - (Qnew - bvirt) + (fnow - bvirt);
          fnow = f[++findex];
        }
        Q = Qnew;
        if (hh !== 0) {
          h[hindex++] = hh;
        }
      }
    }
    while (eindex < elen) {
      Qnew = Q + enow;
      bvirt = Qnew - Q;
      hh = Q - (Qnew - bvirt) + (enow - bvirt);
      enow = e[++eindex];
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
    }
    while (findex < flen) {
      Qnew = Q + fnow;
      bvirt = Qnew - Q;
      hh = Q - (Qnew - bvirt) + (fnow - bvirt);
      fnow = f[++findex];
      Q = Qnew;
      if (hh !== 0) {
        h[hindex++] = hh;
      }
    }
    if (Q !== 0 || hindex === 0) {
      h[hindex++] = Q;
    }
    return hindex;
  }
  function estimate2(elen, e) {
    let Q = e[0];
    for (let i = 1; i < elen; i++) Q += e[i];
    return Q;
  }
  function vec2(n) {
    return new Float64Array(n);
  }

  // node_modules/.pnpm/robust-predicates@3.0.3/node_modules/robust-predicates/esm/orient2d.js
  var ccwerrboundA2 = (3 + 16 * epsilon2) * epsilon2;
  var ccwerrboundB2 = (2 + 12 * epsilon2) * epsilon2;
  var ccwerrboundC2 = (9 + 64 * epsilon2) * epsilon2 * epsilon2;
  var B2 = vec2(4);
  var C12 = vec2(8);
  var C22 = vec2(12);
  var D2 = vec2(16);
  var u4 = vec2(4);
  function orient2dadapt2(ax, ay, bx, by, cx, cy, detsum) {
    let acxtail, acytail, bcxtail, bcytail;
    let bvirt, c, ahi, alo, bhi, blo, _i, _j, _0, s1, s0, t1, t0, u32;
    const acx = ax - cx;
    const bcx = bx - cx;
    const acy = ay - cy;
    const bcy = by - cy;
    s1 = acx * bcy;
    c = splitter2 * acx;
    ahi = c - (c - acx);
    alo = acx - ahi;
    c = splitter2 * bcy;
    bhi = c - (c - bcy);
    blo = bcy - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acy * bcx;
    c = splitter2 * acy;
    ahi = c - (c - acy);
    alo = acy - ahi;
    c = splitter2 * bcx;
    bhi = c - (c - bcx);
    blo = bcx - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    B2[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    B2[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    B2[2] = _j - (u32 - bvirt) + (_i - bvirt);
    B2[3] = u32;
    let det = estimate2(4, B2);
    let errbound = ccwerrboundB2 * detsum;
    if (det >= errbound || -det >= errbound) {
      return det;
    }
    bvirt = ax - acx;
    acxtail = ax - (acx + bvirt) + (bvirt - cx);
    bvirt = bx - bcx;
    bcxtail = bx - (bcx + bvirt) + (bvirt - cx);
    bvirt = ay - acy;
    acytail = ay - (acy + bvirt) + (bvirt - cy);
    bvirt = by - bcy;
    bcytail = by - (bcy + bvirt) + (bvirt - cy);
    if (acxtail === 0 && acytail === 0 && bcxtail === 0 && bcytail === 0) {
      return det;
    }
    errbound = ccwerrboundC2 * detsum + resulterrbound2 * Math.abs(det);
    det += acx * bcytail + bcy * acxtail - (acy * bcxtail + bcx * acytail);
    if (det >= errbound || -det >= errbound) return det;
    s1 = acxtail * bcy;
    c = splitter2 * acxtail;
    ahi = c - (c - acxtail);
    alo = acxtail - ahi;
    c = splitter2 * bcy;
    bhi = c - (c - bcy);
    blo = bcy - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acytail * bcx;
    c = splitter2 * acytail;
    ahi = c - (c - acytail);
    alo = acytail - ahi;
    c = splitter2 * bcx;
    bhi = c - (c - bcx);
    blo = bcx - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u4[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u4[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u4[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u4[3] = u32;
    const C1len = sum2(4, B2, 4, u4, C12);
    s1 = acx * bcytail;
    c = splitter2 * acx;
    ahi = c - (c - acx);
    alo = acx - ahi;
    c = splitter2 * bcytail;
    bhi = c - (c - bcytail);
    blo = bcytail - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acy * bcxtail;
    c = splitter2 * acy;
    ahi = c - (c - acy);
    alo = acy - ahi;
    c = splitter2 * bcxtail;
    bhi = c - (c - bcxtail);
    blo = bcxtail - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u4[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u4[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u4[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u4[3] = u32;
    const C2len = sum2(C1len, C12, 4, u4, C22);
    s1 = acxtail * bcytail;
    c = splitter2 * acxtail;
    ahi = c - (c - acxtail);
    alo = acxtail - ahi;
    c = splitter2 * bcytail;
    bhi = c - (c - bcytail);
    blo = bcytail - bhi;
    s0 = alo * blo - (s1 - ahi * bhi - alo * bhi - ahi * blo);
    t1 = acytail * bcxtail;
    c = splitter2 * acytail;
    ahi = c - (c - acytail);
    alo = acytail - ahi;
    c = splitter2 * bcxtail;
    bhi = c - (c - bcxtail);
    blo = bcxtail - bhi;
    t0 = alo * blo - (t1 - ahi * bhi - alo * bhi - ahi * blo);
    _i = s0 - t0;
    bvirt = s0 - _i;
    u4[0] = s0 - (_i + bvirt) + (bvirt - t0);
    _j = s1 + _i;
    bvirt = _j - s1;
    _0 = s1 - (_j - bvirt) + (_i - bvirt);
    _i = _0 - t1;
    bvirt = _0 - _i;
    u4[1] = _0 - (_i + bvirt) + (bvirt - t1);
    u32 = _j + _i;
    bvirt = u32 - _j;
    u4[2] = _j - (u32 - bvirt) + (_i - bvirt);
    u4[3] = u32;
    const Dlen = sum2(C2len, C22, 4, u4, D2);
    return D2[Dlen - 1];
  }
  function orient2d2(ax, ay, bx, by, cx, cy) {
    const detleft = (ay - cy) * (bx - cx);
    const detright = (ax - cx) * (by - cy);
    const det = detleft - detright;
    const detsum = Math.abs(detleft + detright);
    if (Math.abs(det) >= ccwerrboundA2 * detsum) return det;
    return -orient2dadapt2(ax, ay, bx, by, cx, cy, detsum);
  }

  // node_modules/.pnpm/robust-predicates@3.0.3/node_modules/robust-predicates/esm/orient3d.js
  var o3derrboundA2 = (7 + 56 * epsilon2) * epsilon2;
  var o3derrboundB2 = (3 + 28 * epsilon2) * epsilon2;
  var o3derrboundC2 = (26 + 288 * epsilon2) * epsilon2 * epsilon2;
  var bc4 = vec2(4);
  var ca3 = vec2(4);
  var ab4 = vec2(4);
  var at_b2 = vec2(4);
  var at_c2 = vec2(4);
  var bt_c2 = vec2(4);
  var bt_a2 = vec2(4);
  var ct_a2 = vec2(4);
  var ct_b2 = vec2(4);
  var bct3 = vec2(8);
  var cat3 = vec2(8);
  var abt3 = vec2(8);
  var u5 = vec2(4);
  var _84 = vec2(8);
  var _8b3 = vec2(8);
  var _164 = vec2(16);
  var _122 = vec2(12);
  var fin5 = vec2(192);
  var fin23 = vec2(192);

  // node_modules/.pnpm/robust-predicates@3.0.3/node_modules/robust-predicates/esm/incircle.js
  var iccerrboundA2 = (10 + 96 * epsilon2) * epsilon2;
  var iccerrboundB2 = (4 + 48 * epsilon2) * epsilon2;
  var iccerrboundC2 = (44 + 576 * epsilon2) * epsilon2 * epsilon2;
  var bc5 = vec2(4);
  var ca4 = vec2(4);
  var ab5 = vec2(4);
  var aa2 = vec2(4);
  var bb2 = vec2(4);
  var cc2 = vec2(4);
  var u6 = vec2(4);
  var v2 = vec2(4);
  var axtbc2 = vec2(8);
  var aytbc2 = vec2(8);
  var bxtca2 = vec2(8);
  var bytca2 = vec2(8);
  var cxtab2 = vec2(8);
  var cytab2 = vec2(8);
  var abt4 = vec2(8);
  var bct4 = vec2(8);
  var cat4 = vec2(8);
  var abtt2 = vec2(4);
  var bctt2 = vec2(4);
  var catt2 = vec2(4);
  var _85 = vec2(8);
  var _165 = vec2(16);
  var _16b2 = vec2(16);
  var _16c2 = vec2(16);
  var _322 = vec2(32);
  var _32b2 = vec2(32);
  var _483 = vec2(48);
  var _642 = vec2(64);
  var fin6 = vec2(1152);
  var fin24 = vec2(1152);

  // node_modules/.pnpm/robust-predicates@3.0.3/node_modules/robust-predicates/esm/insphere.js
  var isperrboundA2 = (16 + 224 * epsilon2) * epsilon2;
  var isperrboundB2 = (5 + 72 * epsilon2) * epsilon2;
  var isperrboundC2 = (71 + 1408 * epsilon2) * epsilon2 * epsilon2;
  var ab6 = vec2(4);
  var bc6 = vec2(4);
  var cd2 = vec2(4);
  var de2 = vec2(4);
  var ea2 = vec2(4);
  var ac2 = vec2(4);
  var bd2 = vec2(4);
  var ce2 = vec2(4);
  var da2 = vec2(4);
  var eb2 = vec2(4);
  var abc2 = vec2(24);
  var bcd2 = vec2(24);
  var cde2 = vec2(24);
  var dea2 = vec2(24);
  var eab2 = vec2(24);
  var abd2 = vec2(24);
  var bce2 = vec2(24);
  var cda2 = vec2(24);
  var deb2 = vec2(24);
  var eac2 = vec2(24);
  var adet2 = vec2(1152);
  var bdet2 = vec2(1152);
  var cdet2 = vec2(1152);
  var ddet2 = vec2(1152);
  var edet2 = vec2(1152);
  var abdet2 = vec2(2304);
  var cddet2 = vec2(2304);
  var cdedet2 = vec2(3456);
  var deter2 = vec2(5760);
  var _86 = vec2(8);
  var _8b4 = vec2(8);
  var _8c2 = vec2(8);
  var _166 = vec2(16);
  var _242 = vec2(24);
  var _484 = vec2(48);
  var _48b2 = vec2(48);
  var _962 = vec2(96);
  var _1922 = vec2(192);
  var _384x2 = vec2(384);
  var _384y2 = vec2(384);
  var _384z2 = vec2(384);
  var _7682 = vec2(768);
  var xdet2 = vec2(96);
  var ydet2 = vec2(96);
  var zdet2 = vec2(96);
  var fin7 = vec2(1152);

  // node_modules/.pnpm/point-in-polygon-hao@1.2.4/node_modules/point-in-polygon-hao/dist/esm/index.js
  function pointInPolygon(p, polygon) {
    var i;
    var ii;
    var k = 0;
    var f;
    var u1;
    var v1;
    var u22;
    var v22;
    var currentP;
    var nextP;
    var x = p[0];
    var y = p[1];
    var numContours = polygon.length;
    for (i = 0; i < numContours; i++) {
      ii = 0;
      var contour = polygon[i];
      var contourLen = contour.length - 1;
      currentP = contour[0];
      if (currentP[0] !== contour[contourLen][0] && currentP[1] !== contour[contourLen][1]) {
        throw new Error("First and last coordinates in a ring must be the same");
      }
      u1 = currentP[0] - x;
      v1 = currentP[1] - y;
      for (ii; ii < contourLen; ii++) {
        nextP = contour[ii + 1];
        u22 = nextP[0] - x;
        v22 = nextP[1] - y;
        if (v1 === 0 && v22 === 0) {
          if (u22 <= 0 && u1 >= 0 || u1 <= 0 && u22 >= 0) {
            return 0;
          }
        } else if (v22 >= 0 && v1 <= 0 || v22 <= 0 && v1 >= 0) {
          f = orient2d2(u1, u22, v1, v22, 0, 0);
          if (f === 0) {
            return 0;
          }
          if (f > 0 && v22 > 0 && v1 <= 0 || f < 0 && v22 <= 0 && v1 > 0) {
            k++;
          }
        }
        currentP = nextP;
        v1 = v22;
        u1 = u22;
      }
    }
    if (k % 2 === 0) {
      return false;
    }
    return true;
  }

  // node_modules/.pnpm/@turf+boolean-point-in-polygon@7.4.0/node_modules/@turf/boolean-point-in-polygon/dist/esm/index.js
  function booleanPointInPolygon(point2, polygon, options = {}) {
    if (!point2) {
      throw new Error("point is required");
    }
    if (!polygon) {
      throw new Error("polygon is required");
    }
    const pt2 = getCoord(point2);
    const geom = getGeom(polygon);
    const type = geom.type;
    const bbox3 = polygon.bbox;
    let polys = geom.coordinates;
    if (bbox3 && inBBox(pt2, bbox3) === false) {
      return false;
    }
    if (type === "Polygon") {
      polys = [polys];
    }
    for (var i = 0; i < polys.length; ++i) {
      const polyResult = pointInPolygon(pt2, polys[i]);
      if (polyResult === 0 && !options.ignoreBoundary) return true;
      else if (polyResult) return true;
    }
    return false;
  }
  function inBBox(pt2, bbox3) {
    return bbox3[0] <= pt2[0] && bbox3[1] <= pt2[1] && bbox3[2] >= pt2[0] && bbox3[3] >= pt2[1];
  }

  // node_modules/.pnpm/@turf+boolean-point-on-line@7.4.0/node_modules/@turf/boolean-point-on-line/dist/esm/index.js
  function booleanPointOnLine(pt2, line, options = {}) {
    const ptCoords = getCoord(pt2);
    const lineCoords = getCoords(line);
    for (let i = 0; i < lineCoords.length - 1; i++) {
      let ignoreBoundary = false;
      if (options.ignoreEndVertices) {
        if (i === 0) {
          ignoreBoundary = "start";
        }
        if (i === lineCoords.length - 2) {
          ignoreBoundary = "end";
        }
        if (i === 0 && i + 1 === lineCoords.length - 1) {
          ignoreBoundary = "both";
        }
      }
      if (isPointOnLineSegment(
        lineCoords[i],
        lineCoords[i + 1],
        ptCoords,
        ignoreBoundary,
        typeof options.epsilon === "undefined" ? null : options.epsilon
      )) {
        return true;
      }
    }
    return false;
  }
  function isPointOnLineSegment(lineSegmentStart, lineSegmentEnd, pt2, excludeBoundary, epsilon3) {
    const x = pt2[0];
    const y = pt2[1];
    const x1 = lineSegmentStart[0];
    const y1 = lineSegmentStart[1];
    const x2 = lineSegmentEnd[0];
    const y2 = lineSegmentEnd[1];
    const dxc = pt2[0] - x1;
    const dyc = pt2[1] - y1;
    const dxl = x2 - x1;
    const dyl = y2 - y1;
    const cross2 = dxc * dyl - dyc * dxl;
    if (epsilon3 !== null) {
      if (Math.abs(cross2) > epsilon3) {
        return false;
      }
    } else if (cross2 !== 0) {
      return false;
    }
    if (Math.abs(dxl) === Math.abs(dyl) && Math.abs(dxl) === 0) {
      if (excludeBoundary) {
        return false;
      }
      if (pt2[0] === lineSegmentStart[0] && pt2[1] === lineSegmentStart[1]) {
        return true;
      } else {
        return false;
      }
    }
    if (!excludeBoundary) {
      if (Math.abs(dxl) >= Math.abs(dyl)) {
        return dxl > 0 ? x1 <= x && x <= x2 : x2 <= x && x <= x1;
      }
      return dyl > 0 ? y1 <= y && y <= y2 : y2 <= y && y <= y1;
    } else if (excludeBoundary === "start") {
      if (Math.abs(dxl) >= Math.abs(dyl)) {
        return dxl > 0 ? x1 < x && x <= x2 : x2 <= x && x < x1;
      }
      return dyl > 0 ? y1 < y && y <= y2 : y2 <= y && y < y1;
    } else if (excludeBoundary === "end") {
      if (Math.abs(dxl) >= Math.abs(dyl)) {
        return dxl > 0 ? x1 <= x && x < x2 : x2 < x && x <= x1;
      }
      return dyl > 0 ? y1 <= y && y < y2 : y2 < y && y <= y1;
    } else if (excludeBoundary === "both") {
      if (Math.abs(dxl) >= Math.abs(dyl)) {
        return dxl > 0 ? x1 < x && x < x2 : x2 < x && x < x1;
      }
      return dyl > 0 ? y1 < y && y < y2 : y2 < y && y < y1;
    }
    return false;
  }

  // node_modules/.pnpm/@turf+boolean-contains@7.4.0/node_modules/@turf/boolean-contains/dist/esm/index.js
  function booleanContains(feature1, feature22) {
    const geom1 = getGeom(feature1);
    const geom2 = getGeom(feature22);
    const type1 = geom1.type;
    const type2 = geom2.type;
    const coords1 = geom1.coordinates;
    const coords2 = geom2.coordinates;
    switch (type1) {
      case "Point":
        switch (type2) {
          case "Point":
            return compareCoords(coords1, coords2);
          default:
            throw new Error("feature2 " + type2 + " geometry not supported");
        }
      case "MultiPoint":
        switch (type2) {
          case "Point":
            return isPointInMultiPoint(geom1, geom2);
          case "MultiPoint":
            return isMultiPointInMultiPoint(geom1, geom2);
          default:
            throw new Error("feature2 " + type2 + " geometry not supported");
        }
      case "LineString":
        switch (type2) {
          case "Point":
            return booleanPointOnLine(geom2, geom1, { ignoreEndVertices: true });
          case "LineString":
            return isLineOnLine(geom1, geom2);
          case "MultiPoint":
            return isMultiPointOnLine(geom1, geom2);
          default:
            throw new Error("feature2 " + type2 + " geometry not supported");
        }
      case "Polygon":
        switch (type2) {
          case "Point":
            return booleanPointInPolygon(geom2, geom1, { ignoreBoundary: true });
          case "LineString":
            return isLineInPoly(geom1, geom2);
          case "Polygon":
            return isPolyInPoly(geom1, geom2);
          case "MultiPoint":
            return isMultiPointInPoly(geom1, geom2);
          case "MultiPolygon":
            return isMultiPolyInPoly(geom1, geom2);
          default:
            throw new Error("feature2 " + type2 + " geometry not supported");
        }
      case "MultiPolygon":
        switch (type2) {
          case "Point":
            return isPointInMultiPolygon(geom1, geom2);
          case "MultiPoint":
            return isMultiPointInMultiPolygon(geom1, geom2);
          case "LineString":
            return isLineInMultiPolygon(geom1, geom2);
          case "MultiLineString":
            return isMultiLineStringInMultiPolygon(geom1, geom2);
          case "Polygon":
            return isPolygonInMultiPolygon(geom1, geom2);
          case "MultiPolygon":
            return isMultiPolygonInMultiPolygon(geom1, geom2);
          default:
            throw new Error("feature2 " + type2 + " geometry not supported");
        }
      default:
        throw new Error("feature1 " + type1 + " geometry not supported");
    }
  }
  function isPolygonInMultiPolygon(multiPolygon, polygon) {
    const polygonBbox = bbox(polygon);
    return multiPolygon.coordinates.some(
      (coords) => isPolyInPoly({ type: "Polygon", coordinates: coords }, polygon, polygonBbox)
    );
  }
  function isPointInMultiPolygon(multiPolygon, point2) {
    return booleanPointInPolygon(point2, multiPolygon, { ignoreBoundary: true });
  }
  function isMultiPointInMultiPolygon(multiPolygon, multiPoint) {
    let oneInside = false;
    for (const coord of multiPoint.coordinates) {
      if (!booleanPointInPolygon(coord, multiPolygon)) {
        return false;
      }
      if (!oneInside) {
        oneInside = booleanPointInPolygon(coord, multiPolygon, {
          ignoreBoundary: true
        });
      }
    }
    return oneInside;
  }
  function isLineInMultiPolygon(multiPolygon, lineString2) {
    return multiPolygon.coordinates.some(
      (coords) => isLineInPoly({ type: "Polygon", coordinates: coords }, lineString2)
    );
  }
  function isMultiLineStringInMultiPolygon(multiPolygon, multiLineString) {
    let oneInterior = false;
    for (const lineCoords of multiLineString.coordinates) {
      const line = { type: "LineString", coordinates: lineCoords };
      let lineStatus = "outside";
      for (const polyCoords of multiPolygon.coordinates) {
        const status = lineInPolyStatus(
          { type: "Polygon", coordinates: polyCoords },
          line
        );
        if (status === "interior") {
          lineStatus = status;
          break;
        }
        if (status === "boundary") {
          lineStatus = status;
        }
      }
      if (lineStatus === "outside") {
        return false;
      }
      if (lineStatus === "interior") {
        oneInterior = true;
      }
    }
    return oneInterior;
  }
  function isMultiPolygonInMultiPolygon(multiPolygon1, multiPolygon2) {
    for (const poly2Coords of multiPolygon2.coordinates) {
      const poly2 = { type: "Polygon", coordinates: poly2Coords };
      const poly2Bbox = bbox(poly2);
      const polyInside = multiPolygon1.coordinates.some(
        (poly1Coords) => isPolyInPoly(
          { type: "Polygon", coordinates: poly1Coords },
          poly2,
          poly2Bbox
        )
      );
      if (!polyInside) {
        return false;
      }
    }
    return true;
  }
  function isMultiPolyInPoly(polygon, multiPolygon) {
    return multiPolygon.coordinates.every(
      (coords) => isPolyInPoly(polygon, { type: "Polygon", coordinates: coords })
    );
  }
  function isPointInMultiPoint(multiPoint, pt2) {
    let i;
    let output = false;
    for (i = 0; i < multiPoint.coordinates.length; i++) {
      if (compareCoords(multiPoint.coordinates[i], pt2.coordinates)) {
        output = true;
        break;
      }
    }
    return output;
  }
  function isMultiPointInMultiPoint(multiPoint1, multiPoint2) {
    for (const coord2 of multiPoint2.coordinates) {
      let matchFound = false;
      for (const coord1 of multiPoint1.coordinates) {
        if (compareCoords(coord2, coord1)) {
          matchFound = true;
          break;
        }
      }
      if (!matchFound) {
        return false;
      }
    }
    return true;
  }
  function isMultiPointOnLine(lineString2, multiPoint) {
    let haveFoundInteriorPoint = false;
    for (const coord of multiPoint.coordinates) {
      if (!booleanPointOnLine(coord, lineString2)) {
        return false;
      }
      if (!haveFoundInteriorPoint && booleanPointOnLine(coord, lineString2, { ignoreEndVertices: true })) {
        haveFoundInteriorPoint = true;
      }
    }
    return haveFoundInteriorPoint;
  }
  function isMultiPointInPoly(polygon, multiPoint) {
    let oneInside = false;
    for (const coord of multiPoint.coordinates) {
      if (!booleanPointInPolygon(coord, polygon)) {
        return false;
      }
      if (!oneInside) {
        oneInside = booleanPointInPolygon(coord, polygon, {
          ignoreBoundary: true
        });
      }
    }
    return oneInside;
  }
  function isLineOnLine(lineString1, lineString2) {
    let haveFoundInteriorPoint = false;
    const coordinates = lineString2.coordinates;
    for (let i = 0; i < coordinates.length; i++) {
      const coords = coordinates[i];
      if (!booleanPointOnLine(coords, lineString1)) {
        return false;
      }
      if (!haveFoundInteriorPoint) {
        if (booleanPointOnLine(coords, lineString1, { ignoreEndVertices: true })) {
          haveFoundInteriorPoint = true;
        } else if (i > 0) {
          const midpoint = [
            (coordinates[i - 1][0] + coords[0]) / 2,
            (coordinates[i - 1][1] + coords[1]) / 2
          ];
          if (booleanPointOnLine(midpoint, lineString1, { ignoreEndVertices: true })) {
            haveFoundInteriorPoint = true;
          }
        }
      }
    }
    return haveFoundInteriorPoint;
  }
  function splitLineIntoSegmentsOnPolygon(linestring, polygon) {
    const coords = linestring.coordinates;
    const outputSegments = [];
    for (let i = 0; i < coords.length - 1; i++) {
      const seg = lineString([coords[i], coords[i + 1]]);
      const split = lineSplit(seg, feature(polygon));
      if (split.features.length === 0) {
        outputSegments.push(seg);
      } else {
        outputSegments.push(...split.features);
      }
    }
    return featureCollection(outputSegments);
  }
  function isLineInPoly(polygon, linestring) {
    return lineInPolyStatus(polygon, linestring) === "interior";
  }
  function lineInPolyStatus(polygon, linestring) {
    const polyBbox = bbox(polygon);
    const lineBbox = bbox(linestring);
    if (!doBBoxOverlap(polyBbox, lineBbox)) {
      return "outside";
    }
    for (const coord of linestring.coordinates) {
      if (!booleanPointInPolygon(coord, polygon)) {
        return "outside";
      }
    }
    let hasInteriorSegment = false;
    const lineSegments = splitLineIntoSegmentsOnPolygon(linestring, polygon);
    for (const lineSegment2 of lineSegments.features) {
      const midpoint = getMidpoint(
        lineSegment2.geometry.coordinates[0],
        lineSegment2.geometry.coordinates[1]
      );
      if (!booleanPointInPolygon(midpoint, polygon)) {
        return "outside";
      }
      if (!hasInteriorSegment && booleanPointInPolygon(midpoint, polygon, { ignoreBoundary: true })) {
        hasInteriorSegment = true;
      }
    }
    return hasInteriorSegment ? "interior" : "boundary";
  }
  function isPolyInPoly(feature1, feature22, feature2Bbox) {
    if (feature1.type === "Feature" && feature1.geometry === null) {
      return false;
    }
    if (feature22.type === "Feature" && feature22.geometry === null) {
      return false;
    }
    const poly1Bbox = bbox(feature1);
    const poly2Bbox = feature2Bbox != null ? feature2Bbox : bbox(feature22);
    if (!doBBoxOverlap(poly1Bbox, poly2Bbox)) {
      return false;
    }
    const poly1 = getGeom(feature1);
    const coords = getGeom(feature22).coordinates;
    for (const ring of coords) {
      for (const coord of ring) {
        if (!booleanPointInPolygon(coord, feature1)) {
          return false;
        }
      }
      const segments = splitLineIntoSegmentsOnPolygon(
        { type: "LineString", coordinates: ring },
        poly1
      );
      for (const segment of segments.features) {
        const midpoint = getMidpoint(
          segment.geometry.coordinates[0],
          segment.geometry.coordinates[1]
        );
        if (!booleanPointInPolygon(midpoint, feature1) && !isPointOnPolygonBoundary(midpoint, poly1)) {
          return false;
        }
      }
    }
    return true;
  }
  var BOUNDARY_DISTANCE_TOLERANCE = 1e-6;
  function pointToSegmentDistance(point2, start, end) {
    const dx = end[0] - start[0];
    const dy = end[1] - start[1];
    const segmentLengthSquared = dx * dx + dy * dy;
    let t = 0;
    if (segmentLengthSquared > 0) {
      t = ((point2[0] - start[0]) * dx + (point2[1] - start[1]) * dy) / segmentLengthSquared;
      t = Math.max(0, Math.min(1, t));
    }
    const closestX = start[0] + t * dx;
    const closestY = start[1] + t * dy;
    const offsetX = point2[0] - closestX;
    const offsetY = point2[1] - closestY;
    return Math.sqrt(offsetX * offsetX + offsetY * offsetY);
  }
  function isPointOnPolygonBoundary(point2, polygon) {
    return polygon.coordinates.some((ring) => {
      for (let i = 0; i < ring.length - 1; i++) {
        if (pointToSegmentDistance(point2, ring[i], ring[i + 1]) <= BOUNDARY_DISTANCE_TOLERANCE) {
          return true;
        }
      }
      return false;
    });
  }
  function doBBoxOverlap(bbox1, bbox22) {
    if (bbox1[0] > bbox22[0]) {
      return false;
    }
    if (bbox1[2] < bbox22[2]) {
      return false;
    }
    if (bbox1[1] > bbox22[1]) {
      return false;
    }
    if (bbox1[3] < bbox22[3]) {
      return false;
    }
    return true;
  }
  function compareCoords(pair1, pair2) {
    return pair1[0] === pair2[0] && pair1[1] === pair2[1];
  }
  function getMidpoint(pair1, pair2) {
    return [(pair1[0] + pair2[0]) / 2, (pair1[1] + pair2[1]) / 2];
  }
  var index_default4 = booleanContains;

  // src/js/Draw/L.PM.Draw.Cut.ts
  var import_get2 = __toESM(require_get());

  // node_modules/.pnpm/bignumber.js@9.3.1/node_modules/bignumber.js/bignumber.mjs
  var isNumeric = /^-?(?:\d+(?:\.\d*)?|\.\d+)(?:e[+-]?\d+)?$/i;
  var mathceil = Math.ceil;
  var mathfloor = Math.floor;
  var bignumberError = "[BigNumber Error] ";
  var tooManyDigits = bignumberError + "Number primitive has more than 15 significant digits: ";
  var BASE = 1e14;
  var LOG_BASE = 14;
  var MAX_SAFE_INTEGER = 9007199254740991;
  var POWS_TEN = [1, 10, 100, 1e3, 1e4, 1e5, 1e6, 1e7, 1e8, 1e9, 1e10, 1e11, 1e12, 1e13];
  var SQRT_BASE = 1e7;
  var MAX = 1e9;
  function clone(configObject) {
    var div, convertBase, parseNumeric, P = BigNumber2.prototype = { constructor: BigNumber2, toString: null, valueOf: null }, ONE = new BigNumber2(1), DECIMAL_PLACES = 20, ROUNDING_MODE = 4, TO_EXP_NEG = -7, TO_EXP_POS = 21, MIN_EXP = -1e7, MAX_EXP = 1e7, CRYPTO = false, MODULO_MODE = 1, POW_PRECISION = 0, FORMAT = {
      prefix: "",
      groupSize: 3,
      secondaryGroupSize: 0,
      groupSeparator: ",",
      decimalSeparator: ".",
      fractionGroupSize: 0,
      fractionGroupSeparator: "\xA0",
      // non-breaking space
      suffix: ""
    }, ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyz", alphabetHasNormalDecimalDigits = true;
    function BigNumber2(v3, b) {
      var alphabet, c, caseChanged, e, i, isNum, len, str, x = this;
      if (!(x instanceof BigNumber2)) return new BigNumber2(v3, b);
      if (b == null) {
        if (v3 && v3._isBigNumber === true) {
          x.s = v3.s;
          if (!v3.c || v3.e > MAX_EXP) {
            x.c = x.e = null;
          } else if (v3.e < MIN_EXP) {
            x.c = [x.e = 0];
          } else {
            x.e = v3.e;
            x.c = v3.c.slice();
          }
          return;
        }
        if ((isNum = typeof v3 == "number") && v3 * 0 == 0) {
          x.s = 1 / v3 < 0 ? (v3 = -v3, -1) : 1;
          if (v3 === ~~v3) {
            for (e = 0, i = v3; i >= 10; i /= 10, e++) ;
            if (e > MAX_EXP) {
              x.c = x.e = null;
            } else {
              x.e = e;
              x.c = [v3];
            }
            return;
          }
          str = String(v3);
        } else {
          if (!isNumeric.test(str = String(v3))) return parseNumeric(x, str, isNum);
          x.s = str.charCodeAt(0) == 45 ? (str = str.slice(1), -1) : 1;
        }
        if ((e = str.indexOf(".")) > -1) str = str.replace(".", "");
        if ((i = str.search(/e/i)) > 0) {
          if (e < 0) e = i;
          e += +str.slice(i + 1);
          str = str.substring(0, i);
        } else if (e < 0) {
          e = str.length;
        }
      } else {
        intCheck(b, 2, ALPHABET.length, "Base");
        if (b == 10 && alphabetHasNormalDecimalDigits) {
          x = new BigNumber2(v3);
          return round(x, DECIMAL_PLACES + x.e + 1, ROUNDING_MODE);
        }
        str = String(v3);
        if (isNum = typeof v3 == "number") {
          if (v3 * 0 != 0) return parseNumeric(x, str, isNum, b);
          x.s = 1 / v3 < 0 ? (str = str.slice(1), -1) : 1;
          if (BigNumber2.DEBUG && str.replace(/^0\.0*|\./, "").length > 15) {
            throw Error(tooManyDigits + v3);
          }
        } else {
          x.s = str.charCodeAt(0) === 45 ? (str = str.slice(1), -1) : 1;
        }
        alphabet = ALPHABET.slice(0, b);
        e = i = 0;
        for (len = str.length; i < len; i++) {
          if (alphabet.indexOf(c = str.charAt(i)) < 0) {
            if (c == ".") {
              if (i > e) {
                e = len;
                continue;
              }
            } else if (!caseChanged) {
              if (str == str.toUpperCase() && (str = str.toLowerCase()) || str == str.toLowerCase() && (str = str.toUpperCase())) {
                caseChanged = true;
                i = -1;
                e = 0;
                continue;
              }
            }
            return parseNumeric(x, String(v3), isNum, b);
          }
        }
        isNum = false;
        str = convertBase(str, b, 10, x.s);
        if ((e = str.indexOf(".")) > -1) str = str.replace(".", "");
        else e = str.length;
      }
      for (i = 0; str.charCodeAt(i) === 48; i++) ;
      for (len = str.length; str.charCodeAt(--len) === 48; ) ;
      if (str = str.slice(i, ++len)) {
        len -= i;
        if (isNum && BigNumber2.DEBUG && len > 15 && (v3 > MAX_SAFE_INTEGER || v3 !== mathfloor(v3))) {
          throw Error(tooManyDigits + x.s * v3);
        }
        if ((e = e - i - 1) > MAX_EXP) {
          x.c = x.e = null;
        } else if (e < MIN_EXP) {
          x.c = [x.e = 0];
        } else {
          x.e = e;
          x.c = [];
          i = (e + 1) % LOG_BASE;
          if (e < 0) i += LOG_BASE;
          if (i < len) {
            if (i) x.c.push(+str.slice(0, i));
            for (len -= LOG_BASE; i < len; ) {
              x.c.push(+str.slice(i, i += LOG_BASE));
            }
            i = LOG_BASE - (str = str.slice(i)).length;
          } else {
            i -= len;
          }
          for (; i--; str += "0") ;
          x.c.push(+str);
        }
      } else {
        x.c = [x.e = 0];
      }
    }
    BigNumber2.clone = clone;
    BigNumber2.ROUND_UP = 0;
    BigNumber2.ROUND_DOWN = 1;
    BigNumber2.ROUND_CEIL = 2;
    BigNumber2.ROUND_FLOOR = 3;
    BigNumber2.ROUND_HALF_UP = 4;
    BigNumber2.ROUND_HALF_DOWN = 5;
    BigNumber2.ROUND_HALF_EVEN = 6;
    BigNumber2.ROUND_HALF_CEIL = 7;
    BigNumber2.ROUND_HALF_FLOOR = 8;
    BigNumber2.EUCLID = 9;
    BigNumber2.config = BigNumber2.set = function(obj) {
      var p, v3;
      if (obj != null) {
        if (typeof obj == "object") {
          if (obj.hasOwnProperty(p = "DECIMAL_PLACES")) {
            v3 = obj[p];
            intCheck(v3, 0, MAX, p);
            DECIMAL_PLACES = v3;
          }
          if (obj.hasOwnProperty(p = "ROUNDING_MODE")) {
            v3 = obj[p];
            intCheck(v3, 0, 8, p);
            ROUNDING_MODE = v3;
          }
          if (obj.hasOwnProperty(p = "EXPONENTIAL_AT")) {
            v3 = obj[p];
            if (v3 && v3.pop) {
              intCheck(v3[0], -MAX, 0, p);
              intCheck(v3[1], 0, MAX, p);
              TO_EXP_NEG = v3[0];
              TO_EXP_POS = v3[1];
            } else {
              intCheck(v3, -MAX, MAX, p);
              TO_EXP_NEG = -(TO_EXP_POS = v3 < 0 ? -v3 : v3);
            }
          }
          if (obj.hasOwnProperty(p = "RANGE")) {
            v3 = obj[p];
            if (v3 && v3.pop) {
              intCheck(v3[0], -MAX, -1, p);
              intCheck(v3[1], 1, MAX, p);
              MIN_EXP = v3[0];
              MAX_EXP = v3[1];
            } else {
              intCheck(v3, -MAX, MAX, p);
              if (v3) {
                MIN_EXP = -(MAX_EXP = v3 < 0 ? -v3 : v3);
              } else {
                throw Error(bignumberError + p + " cannot be zero: " + v3);
              }
            }
          }
          if (obj.hasOwnProperty(p = "CRYPTO")) {
            v3 = obj[p];
            if (v3 === !!v3) {
              if (v3) {
                if (typeof crypto != "undefined" && crypto && (crypto.getRandomValues || crypto.randomBytes)) {
                  CRYPTO = v3;
                } else {
                  CRYPTO = !v3;
                  throw Error(bignumberError + "crypto unavailable");
                }
              } else {
                CRYPTO = v3;
              }
            } else {
              throw Error(bignumberError + p + " not true or false: " + v3);
            }
          }
          if (obj.hasOwnProperty(p = "MODULO_MODE")) {
            v3 = obj[p];
            intCheck(v3, 0, 9, p);
            MODULO_MODE = v3;
          }
          if (obj.hasOwnProperty(p = "POW_PRECISION")) {
            v3 = obj[p];
            intCheck(v3, 0, MAX, p);
            POW_PRECISION = v3;
          }
          if (obj.hasOwnProperty(p = "FORMAT")) {
            v3 = obj[p];
            if (typeof v3 == "object") FORMAT = v3;
            else throw Error(bignumberError + p + " not an object: " + v3);
          }
          if (obj.hasOwnProperty(p = "ALPHABET")) {
            v3 = obj[p];
            if (typeof v3 == "string" && !/^.?$|[+\-.\s]|(.).*\1/.test(v3)) {
              alphabetHasNormalDecimalDigits = v3.slice(0, 10) == "0123456789";
              ALPHABET = v3;
            } else {
              throw Error(bignumberError + p + " invalid: " + v3);
            }
          }
        } else {
          throw Error(bignumberError + "Object expected: " + obj);
        }
      }
      return {
        DECIMAL_PLACES,
        ROUNDING_MODE,
        EXPONENTIAL_AT: [TO_EXP_NEG, TO_EXP_POS],
        RANGE: [MIN_EXP, MAX_EXP],
        CRYPTO,
        MODULO_MODE,
        POW_PRECISION,
        FORMAT,
        ALPHABET
      };
    };
    BigNumber2.isBigNumber = function(v3) {
      if (!v3 || v3._isBigNumber !== true) return false;
      if (!BigNumber2.DEBUG) return true;
      var i, n, c = v3.c, e = v3.e, s = v3.s;
      out: if ({}.toString.call(c) == "[object Array]") {
        if ((s === 1 || s === -1) && e >= -MAX && e <= MAX && e === mathfloor(e)) {
          if (c[0] === 0) {
            if (e === 0 && c.length === 1) return true;
            break out;
          }
          i = (e + 1) % LOG_BASE;
          if (i < 1) i += LOG_BASE;
          if (String(c[0]).length == i) {
            for (i = 0; i < c.length; i++) {
              n = c[i];
              if (n < 0 || n >= BASE || n !== mathfloor(n)) break out;
            }
            if (n !== 0) return true;
          }
        }
      } else if (c === null && e === null && (s === null || s === 1 || s === -1)) {
        return true;
      }
      throw Error(bignumberError + "Invalid BigNumber: " + v3);
    };
    BigNumber2.maximum = BigNumber2.max = function() {
      return maxOrMin(arguments, -1);
    };
    BigNumber2.minimum = BigNumber2.min = function() {
      return maxOrMin(arguments, 1);
    };
    BigNumber2.random = (function() {
      var pow2_53 = 9007199254740992;
      var random53bitInt = Math.random() * pow2_53 & 2097151 ? function() {
        return mathfloor(Math.random() * pow2_53);
      } : function() {
        return (Math.random() * 1073741824 | 0) * 8388608 + (Math.random() * 8388608 | 0);
      };
      return function(dp) {
        var a, b, e, k, v3, i = 0, c = [], rand = new BigNumber2(ONE);
        if (dp == null) dp = DECIMAL_PLACES;
        else intCheck(dp, 0, MAX);
        k = mathceil(dp / LOG_BASE);
        if (CRYPTO) {
          if (crypto.getRandomValues) {
            a = crypto.getRandomValues(new Uint32Array(k *= 2));
            for (; i < k; ) {
              v3 = a[i] * 131072 + (a[i + 1] >>> 11);
              if (v3 >= 9e15) {
                b = crypto.getRandomValues(new Uint32Array(2));
                a[i] = b[0];
                a[i + 1] = b[1];
              } else {
                c.push(v3 % 1e14);
                i += 2;
              }
            }
            i = k / 2;
          } else if (crypto.randomBytes) {
            a = crypto.randomBytes(k *= 7);
            for (; i < k; ) {
              v3 = (a[i] & 31) * 281474976710656 + a[i + 1] * 1099511627776 + a[i + 2] * 4294967296 + a[i + 3] * 16777216 + (a[i + 4] << 16) + (a[i + 5] << 8) + a[i + 6];
              if (v3 >= 9e15) {
                crypto.randomBytes(7).copy(a, i);
              } else {
                c.push(v3 % 1e14);
                i += 7;
              }
            }
            i = k / 7;
          } else {
            CRYPTO = false;
            throw Error(bignumberError + "crypto unavailable");
          }
        }
        if (!CRYPTO) {
          for (; i < k; ) {
            v3 = random53bitInt();
            if (v3 < 9e15) c[i++] = v3 % 1e14;
          }
        }
        k = c[--i];
        dp %= LOG_BASE;
        if (k && dp) {
          v3 = POWS_TEN[LOG_BASE - dp];
          c[i] = mathfloor(k / v3) * v3;
        }
        for (; c[i] === 0; c.pop(), i--) ;
        if (i < 0) {
          c = [e = 0];
        } else {
          for (e = -1; c[0] === 0; c.splice(0, 1), e -= LOG_BASE) ;
          for (i = 1, v3 = c[0]; v3 >= 10; v3 /= 10, i++) ;
          if (i < LOG_BASE) e -= LOG_BASE - i;
        }
        rand.e = e;
        rand.c = c;
        return rand;
      };
    })();
    BigNumber2.sum = function() {
      var i = 1, args = arguments, sum3 = new BigNumber2(args[0]);
      for (; i < args.length; ) sum3 = sum3.plus(args[i++]);
      return sum3;
    };
    convertBase = /* @__PURE__ */ (function() {
      var decimal = "0123456789";
      function toBaseOut(str, baseIn, baseOut, alphabet) {
        var j, arr = [0], arrL, i = 0, len = str.length;
        for (; i < len; ) {
          for (arrL = arr.length; arrL--; arr[arrL] *= baseIn) ;
          arr[0] += alphabet.indexOf(str.charAt(i++));
          for (j = 0; j < arr.length; j++) {
            if (arr[j] > baseOut - 1) {
              if (arr[j + 1] == null) arr[j + 1] = 0;
              arr[j + 1] += arr[j] / baseOut | 0;
              arr[j] %= baseOut;
            }
          }
        }
        return arr.reverse();
      }
      return function(str, baseIn, baseOut, sign, callerIsToString) {
        var alphabet, d, e, k, r, x, xc, y, i = str.indexOf("."), dp = DECIMAL_PLACES, rm = ROUNDING_MODE;
        if (i >= 0) {
          k = POW_PRECISION;
          POW_PRECISION = 0;
          str = str.replace(".", "");
          y = new BigNumber2(baseIn);
          x = y.pow(str.length - i);
          POW_PRECISION = k;
          y.c = toBaseOut(
            toFixedPoint(coeffToString(x.c), x.e, "0"),
            10,
            baseOut,
            decimal
          );
          y.e = y.c.length;
        }
        xc = toBaseOut(str, baseIn, baseOut, callerIsToString ? (alphabet = ALPHABET, decimal) : (alphabet = decimal, ALPHABET));
        e = k = xc.length;
        for (; xc[--k] == 0; xc.pop()) ;
        if (!xc[0]) return alphabet.charAt(0);
        if (i < 0) {
          --e;
        } else {
          x.c = xc;
          x.e = e;
          x.s = sign;
          x = div(x, y, dp, rm, baseOut);
          xc = x.c;
          r = x.r;
          e = x.e;
        }
        d = e + dp + 1;
        i = xc[d];
        k = baseOut / 2;
        r = r || d < 0 || xc[d + 1] != null;
        r = rm < 4 ? (i != null || r) && (rm == 0 || rm == (x.s < 0 ? 3 : 2)) : i > k || i == k && (rm == 4 || r || rm == 6 && xc[d - 1] & 1 || rm == (x.s < 0 ? 8 : 7));
        if (d < 1 || !xc[0]) {
          str = r ? toFixedPoint(alphabet.charAt(1), -dp, alphabet.charAt(0)) : alphabet.charAt(0);
        } else {
          xc.length = d;
          if (r) {
            for (--baseOut; ++xc[--d] > baseOut; ) {
              xc[d] = 0;
              if (!d) {
                ++e;
                xc = [1].concat(xc);
              }
            }
          }
          for (k = xc.length; !xc[--k]; ) ;
          for (i = 0, str = ""; i <= k; str += alphabet.charAt(xc[i++])) ;
          str = toFixedPoint(str, e, alphabet.charAt(0));
        }
        return str;
      };
    })();
    div = /* @__PURE__ */ (function() {
      function multiply(x, k, base) {
        var m, temp, xlo, xhi, carry = 0, i = x.length, klo = k % SQRT_BASE, khi = k / SQRT_BASE | 0;
        for (x = x.slice(); i--; ) {
          xlo = x[i] % SQRT_BASE;
          xhi = x[i] / SQRT_BASE | 0;
          m = khi * xlo + xhi * klo;
          temp = klo * xlo + m % SQRT_BASE * SQRT_BASE + carry;
          carry = (temp / base | 0) + (m / SQRT_BASE | 0) + khi * xhi;
          x[i] = temp % base;
        }
        if (carry) x = [carry].concat(x);
        return x;
      }
      function compare2(a, b, aL, bL) {
        var i, cmp;
        if (aL != bL) {
          cmp = aL > bL ? 1 : -1;
        } else {
          for (i = cmp = 0; i < aL; i++) {
            if (a[i] != b[i]) {
              cmp = a[i] > b[i] ? 1 : -1;
              break;
            }
          }
        }
        return cmp;
      }
      function subtract(a, b, aL, base) {
        var i = 0;
        for (; aL--; ) {
          a[aL] -= i;
          i = a[aL] < b[aL] ? 1 : 0;
          a[aL] = i * base + a[aL] - b[aL];
        }
        for (; !a[0] && a.length > 1; a.splice(0, 1)) ;
      }
      return function(x, y, dp, rm, base) {
        var cmp, e, i, more, n, prod, prodL, q, qc, rem, remL, rem0, xi, xL, yc0, yL, yz, s = x.s == y.s ? 1 : -1, xc = x.c, yc = y.c;
        if (!xc || !xc[0] || !yc || !yc[0]) {
          return new BigNumber2(
            // Return NaN if either NaN, or both Infinity or 0.
            !x.s || !y.s || (xc ? yc && xc[0] == yc[0] : !yc) ? NaN : (
              // Return ±0 if x is ±0 or y is ±Infinity, or return ±Infinity as y is ±0.
              xc && xc[0] == 0 || !yc ? s * 0 : s / 0
            )
          );
        }
        q = new BigNumber2(s);
        qc = q.c = [];
        e = x.e - y.e;
        s = dp + e + 1;
        if (!base) {
          base = BASE;
          e = bitFloor(x.e / LOG_BASE) - bitFloor(y.e / LOG_BASE);
          s = s / LOG_BASE | 0;
        }
        for (i = 0; yc[i] == (xc[i] || 0); i++) ;
        if (yc[i] > (xc[i] || 0)) e--;
        if (s < 0) {
          qc.push(1);
          more = true;
        } else {
          xL = xc.length;
          yL = yc.length;
          i = 0;
          s += 2;
          n = mathfloor(base / (yc[0] + 1));
          if (n > 1) {
            yc = multiply(yc, n, base);
            xc = multiply(xc, n, base);
            yL = yc.length;
            xL = xc.length;
          }
          xi = yL;
          rem = xc.slice(0, yL);
          remL = rem.length;
          for (; remL < yL; rem[remL++] = 0) ;
          yz = yc.slice();
          yz = [0].concat(yz);
          yc0 = yc[0];
          if (yc[1] >= base / 2) yc0++;
          do {
            n = 0;
            cmp = compare2(yc, rem, yL, remL);
            if (cmp < 0) {
              rem0 = rem[0];
              if (yL != remL) rem0 = rem0 * base + (rem[1] || 0);
              n = mathfloor(rem0 / yc0);
              if (n > 1) {
                if (n >= base) n = base - 1;
                prod = multiply(yc, n, base);
                prodL = prod.length;
                remL = rem.length;
                while (compare2(prod, rem, prodL, remL) == 1) {
                  n--;
                  subtract(prod, yL < prodL ? yz : yc, prodL, base);
                  prodL = prod.length;
                  cmp = 1;
                }
              } else {
                if (n == 0) {
                  cmp = n = 1;
                }
                prod = yc.slice();
                prodL = prod.length;
              }
              if (prodL < remL) prod = [0].concat(prod);
              subtract(rem, prod, remL, base);
              remL = rem.length;
              if (cmp == -1) {
                while (compare2(yc, rem, yL, remL) < 1) {
                  n++;
                  subtract(rem, yL < remL ? yz : yc, remL, base);
                  remL = rem.length;
                }
              }
            } else if (cmp === 0) {
              n++;
              rem = [0];
            }
            qc[i++] = n;
            if (rem[0]) {
              rem[remL++] = xc[xi] || 0;
            } else {
              rem = [xc[xi]];
              remL = 1;
            }
          } while ((xi++ < xL || rem[0] != null) && s--);
          more = rem[0] != null;
          if (!qc[0]) qc.splice(0, 1);
        }
        if (base == BASE) {
          for (i = 1, s = qc[0]; s >= 10; s /= 10, i++) ;
          round(q, dp + (q.e = i + e * LOG_BASE - 1) + 1, rm, more);
        } else {
          q.e = e;
          q.r = +more;
        }
        return q;
      };
    })();
    function format(n, i, rm, id) {
      var c0, e, ne, len, str;
      if (rm == null) rm = ROUNDING_MODE;
      else intCheck(rm, 0, 8);
      if (!n.c) return n.toString();
      c0 = n.c[0];
      ne = n.e;
      if (i == null) {
        str = coeffToString(n.c);
        str = id == 1 || id == 2 && (ne <= TO_EXP_NEG || ne >= TO_EXP_POS) ? toExponential(str, ne) : toFixedPoint(str, ne, "0");
      } else {
        n = round(new BigNumber2(n), i, rm);
        e = n.e;
        str = coeffToString(n.c);
        len = str.length;
        if (id == 1 || id == 2 && (i <= e || e <= TO_EXP_NEG)) {
          for (; len < i; str += "0", len++) ;
          str = toExponential(str, e);
        } else {
          i -= ne + (id === 2 && e > ne);
          str = toFixedPoint(str, e, "0");
          if (e + 1 > len) {
            if (--i > 0) for (str += "."; i--; str += "0") ;
          } else {
            i += e - len;
            if (i > 0) {
              if (e + 1 == len) str += ".";
              for (; i--; str += "0") ;
            }
          }
        }
      }
      return n.s < 0 && c0 ? "-" + str : str;
    }
    function maxOrMin(args, n) {
      var k, y, i = 1, x = new BigNumber2(args[0]);
      for (; i < args.length; i++) {
        y = new BigNumber2(args[i]);
        if (!y.s || (k = compare(x, y)) === n || k === 0 && x.s === n) {
          x = y;
        }
      }
      return x;
    }
    function normalise(n, c, e) {
      var i = 1, j = c.length;
      for (; !c[--j]; c.pop()) ;
      for (j = c[0]; j >= 10; j /= 10, i++) ;
      if ((e = i + e * LOG_BASE - 1) > MAX_EXP) {
        n.c = n.e = null;
      } else if (e < MIN_EXP) {
        n.c = [n.e = 0];
      } else {
        n.e = e;
        n.c = c;
      }
      return n;
    }
    parseNumeric = /* @__PURE__ */ (function() {
      var basePrefix = /^(-?)0([xbo])(?=\w[\w.]*$)/i, dotAfter = /^([^.]+)\.$/, dotBefore = /^\.([^.]+)$/, isInfinityOrNaN = /^-?(Infinity|NaN)$/, whitespaceOrPlus = /^\s*\+(?=[\w.])|^\s+|\s+$/g;
      return function(x, str, isNum, b) {
        var base, s = isNum ? str : str.replace(whitespaceOrPlus, "");
        if (isInfinityOrNaN.test(s)) {
          x.s = isNaN(s) ? null : s < 0 ? -1 : 1;
        } else {
          if (!isNum) {
            s = s.replace(basePrefix, function(m, p1, p2) {
              base = (p2 = p2.toLowerCase()) == "x" ? 16 : p2 == "b" ? 2 : 8;
              return !b || b == base ? p1 : m;
            });
            if (b) {
              base = b;
              s = s.replace(dotAfter, "$1").replace(dotBefore, "0.$1");
            }
            if (str != s) return new BigNumber2(s, base);
          }
          if (BigNumber2.DEBUG) {
            throw Error(bignumberError + "Not a" + (b ? " base " + b : "") + " number: " + str);
          }
          x.s = null;
        }
        x.c = x.e = null;
      };
    })();
    function round(x, sd, rm, r) {
      var d, i, j, k, n, ni, rd, xc = x.c, pows10 = POWS_TEN;
      if (xc) {
        out: {
          for (d = 1, k = xc[0]; k >= 10; k /= 10, d++) ;
          i = sd - d;
          if (i < 0) {
            i += LOG_BASE;
            j = sd;
            n = xc[ni = 0];
            rd = mathfloor(n / pows10[d - j - 1] % 10);
          } else {
            ni = mathceil((i + 1) / LOG_BASE);
            if (ni >= xc.length) {
              if (r) {
                for (; xc.length <= ni; xc.push(0)) ;
                n = rd = 0;
                d = 1;
                i %= LOG_BASE;
                j = i - LOG_BASE + 1;
              } else {
                break out;
              }
            } else {
              n = k = xc[ni];
              for (d = 1; k >= 10; k /= 10, d++) ;
              i %= LOG_BASE;
              j = i - LOG_BASE + d;
              rd = j < 0 ? 0 : mathfloor(n / pows10[d - j - 1] % 10);
            }
          }
          r = r || sd < 0 || // Are there any non-zero digits after the rounding digit?
          // The expression  n % pows10[d - j - 1]  returns all digits of n to the right
          // of the digit at j, e.g. if n is 908714 and j is 2, the expression gives 714.
          xc[ni + 1] != null || (j < 0 ? n : n % pows10[d - j - 1]);
          r = rm < 4 ? (rd || r) && (rm == 0 || rm == (x.s < 0 ? 3 : 2)) : rd > 5 || rd == 5 && (rm == 4 || r || rm == 6 && // Check whether the digit to the left of the rounding digit is odd.
          (i > 0 ? j > 0 ? n / pows10[d - j] : 0 : xc[ni - 1]) % 10 & 1 || rm == (x.s < 0 ? 8 : 7));
          if (sd < 1 || !xc[0]) {
            xc.length = 0;
            if (r) {
              sd -= x.e + 1;
              xc[0] = pows10[(LOG_BASE - sd % LOG_BASE) % LOG_BASE];
              x.e = -sd || 0;
            } else {
              xc[0] = x.e = 0;
            }
            return x;
          }
          if (i == 0) {
            xc.length = ni;
            k = 1;
            ni--;
          } else {
            xc.length = ni + 1;
            k = pows10[LOG_BASE - i];
            xc[ni] = j > 0 ? mathfloor(n / pows10[d - j] % pows10[j]) * k : 0;
          }
          if (r) {
            for (; ; ) {
              if (ni == 0) {
                for (i = 1, j = xc[0]; j >= 10; j /= 10, i++) ;
                j = xc[0] += k;
                for (k = 1; j >= 10; j /= 10, k++) ;
                if (i != k) {
                  x.e++;
                  if (xc[0] == BASE) xc[0] = 1;
                }
                break;
              } else {
                xc[ni] += k;
                if (xc[ni] != BASE) break;
                xc[ni--] = 0;
                k = 1;
              }
            }
          }
          for (i = xc.length; xc[--i] === 0; xc.pop()) ;
        }
        if (x.e > MAX_EXP) {
          x.c = x.e = null;
        } else if (x.e < MIN_EXP) {
          x.c = [x.e = 0];
        }
      }
      return x;
    }
    function valueOf(n) {
      var str, e = n.e;
      if (e === null) return n.toString();
      str = coeffToString(n.c);
      str = e <= TO_EXP_NEG || e >= TO_EXP_POS ? toExponential(str, e) : toFixedPoint(str, e, "0");
      return n.s < 0 ? "-" + str : str;
    }
    P.absoluteValue = P.abs = function() {
      var x = new BigNumber2(this);
      if (x.s < 0) x.s = 1;
      return x;
    };
    P.comparedTo = function(y, b) {
      return compare(this, new BigNumber2(y, b));
    };
    P.decimalPlaces = P.dp = function(dp, rm) {
      var c, n, v3, x = this;
      if (dp != null) {
        intCheck(dp, 0, MAX);
        if (rm == null) rm = ROUNDING_MODE;
        else intCheck(rm, 0, 8);
        return round(new BigNumber2(x), dp + x.e + 1, rm);
      }
      if (!(c = x.c)) return null;
      n = ((v3 = c.length - 1) - bitFloor(this.e / LOG_BASE)) * LOG_BASE;
      if (v3 = c[v3]) for (; v3 % 10 == 0; v3 /= 10, n--) ;
      if (n < 0) n = 0;
      return n;
    };
    P.dividedBy = P.div = function(y, b) {
      return div(this, new BigNumber2(y, b), DECIMAL_PLACES, ROUNDING_MODE);
    };
    P.dividedToIntegerBy = P.idiv = function(y, b) {
      return div(this, new BigNumber2(y, b), 0, 1);
    };
    P.exponentiatedBy = P.pow = function(n, m) {
      var half, isModExp, i, k, more, nIsBig, nIsNeg, nIsOdd, y, x = this;
      n = new BigNumber2(n);
      if (n.c && !n.isInteger()) {
        throw Error(bignumberError + "Exponent not an integer: " + valueOf(n));
      }
      if (m != null) m = new BigNumber2(m);
      nIsBig = n.e > 14;
      if (!x.c || !x.c[0] || x.c[0] == 1 && !x.e && x.c.length == 1 || !n.c || !n.c[0]) {
        y = new BigNumber2(Math.pow(+valueOf(x), nIsBig ? n.s * (2 - isOdd(n)) : +valueOf(n)));
        return m ? y.mod(m) : y;
      }
      nIsNeg = n.s < 0;
      if (m) {
        if (m.c ? !m.c[0] : !m.s) return new BigNumber2(NaN);
        isModExp = !nIsNeg && x.isInteger() && m.isInteger();
        if (isModExp) x = x.mod(m);
      } else if (n.e > 9 && (x.e > 0 || x.e < -1 || (x.e == 0 ? x.c[0] > 1 || nIsBig && x.c[1] >= 24e7 : x.c[0] < 8e13 || nIsBig && x.c[0] <= 9999975e7))) {
        k = x.s < 0 && isOdd(n) ? -0 : 0;
        if (x.e > -1) k = 1 / k;
        return new BigNumber2(nIsNeg ? 1 / k : k);
      } else if (POW_PRECISION) {
        k = mathceil(POW_PRECISION / LOG_BASE + 2);
      }
      if (nIsBig) {
        half = new BigNumber2(0.5);
        if (nIsNeg) n.s = 1;
        nIsOdd = isOdd(n);
      } else {
        i = Math.abs(+valueOf(n));
        nIsOdd = i % 2;
      }
      y = new BigNumber2(ONE);
      for (; ; ) {
        if (nIsOdd) {
          y = y.times(x);
          if (!y.c) break;
          if (k) {
            if (y.c.length > k) y.c.length = k;
          } else if (isModExp) {
            y = y.mod(m);
          }
        }
        if (i) {
          i = mathfloor(i / 2);
          if (i === 0) break;
          nIsOdd = i % 2;
        } else {
          n = n.times(half);
          round(n, n.e + 1, 1);
          if (n.e > 14) {
            nIsOdd = isOdd(n);
          } else {
            i = +valueOf(n);
            if (i === 0) break;
            nIsOdd = i % 2;
          }
        }
        x = x.times(x);
        if (k) {
          if (x.c && x.c.length > k) x.c.length = k;
        } else if (isModExp) {
          x = x.mod(m);
        }
      }
      if (isModExp) return y;
      if (nIsNeg) y = ONE.div(y);
      return m ? y.mod(m) : k ? round(y, POW_PRECISION, ROUNDING_MODE, more) : y;
    };
    P.integerValue = function(rm) {
      var n = new BigNumber2(this);
      if (rm == null) rm = ROUNDING_MODE;
      else intCheck(rm, 0, 8);
      return round(n, n.e + 1, rm);
    };
    P.isEqualTo = P.eq = function(y, b) {
      return compare(this, new BigNumber2(y, b)) === 0;
    };
    P.isFinite = function() {
      return !!this.c;
    };
    P.isGreaterThan = P.gt = function(y, b) {
      return compare(this, new BigNumber2(y, b)) > 0;
    };
    P.isGreaterThanOrEqualTo = P.gte = function(y, b) {
      return (b = compare(this, new BigNumber2(y, b))) === 1 || b === 0;
    };
    P.isInteger = function() {
      return !!this.c && bitFloor(this.e / LOG_BASE) > this.c.length - 2;
    };
    P.isLessThan = P.lt = function(y, b) {
      return compare(this, new BigNumber2(y, b)) < 0;
    };
    P.isLessThanOrEqualTo = P.lte = function(y, b) {
      return (b = compare(this, new BigNumber2(y, b))) === -1 || b === 0;
    };
    P.isNaN = function() {
      return !this.s;
    };
    P.isNegative = function() {
      return this.s < 0;
    };
    P.isPositive = function() {
      return this.s > 0;
    };
    P.isZero = function() {
      return !!this.c && this.c[0] == 0;
    };
    P.minus = function(y, b) {
      var i, j, t, xLTy, x = this, a = x.s;
      y = new BigNumber2(y, b);
      b = y.s;
      if (!a || !b) return new BigNumber2(NaN);
      if (a != b) {
        y.s = -b;
        return x.plus(y);
      }
      var xe = x.e / LOG_BASE, ye = y.e / LOG_BASE, xc = x.c, yc = y.c;
      if (!xe || !ye) {
        if (!xc || !yc) return xc ? (y.s = -b, y) : new BigNumber2(yc ? x : NaN);
        if (!xc[0] || !yc[0]) {
          return yc[0] ? (y.s = -b, y) : new BigNumber2(xc[0] ? x : (
            // IEEE 754 (2008) 6.3: n - n = -0 when rounding to -Infinity
            ROUNDING_MODE == 3 ? -0 : 0
          ));
        }
      }
      xe = bitFloor(xe);
      ye = bitFloor(ye);
      xc = xc.slice();
      if (a = xe - ye) {
        if (xLTy = a < 0) {
          a = -a;
          t = xc;
        } else {
          ye = xe;
          t = yc;
        }
        t.reverse();
        for (b = a; b--; t.push(0)) ;
        t.reverse();
      } else {
        j = (xLTy = (a = xc.length) < (b = yc.length)) ? a : b;
        for (a = b = 0; b < j; b++) {
          if (xc[b] != yc[b]) {
            xLTy = xc[b] < yc[b];
            break;
          }
        }
      }
      if (xLTy) {
        t = xc;
        xc = yc;
        yc = t;
        y.s = -y.s;
      }
      b = (j = yc.length) - (i = xc.length);
      if (b > 0) for (; b--; xc[i++] = 0) ;
      b = BASE - 1;
      for (; j > a; ) {
        if (xc[--j] < yc[j]) {
          for (i = j; i && !xc[--i]; xc[i] = b) ;
          --xc[i];
          xc[j] += BASE;
        }
        xc[j] -= yc[j];
      }
      for (; xc[0] == 0; xc.splice(0, 1), --ye) ;
      if (!xc[0]) {
        y.s = ROUNDING_MODE == 3 ? -1 : 1;
        y.c = [y.e = 0];
        return y;
      }
      return normalise(y, xc, ye);
    };
    P.modulo = P.mod = function(y, b) {
      var q, s, x = this;
      y = new BigNumber2(y, b);
      if (!x.c || !y.s || y.c && !y.c[0]) {
        return new BigNumber2(NaN);
      } else if (!y.c || x.c && !x.c[0]) {
        return new BigNumber2(x);
      }
      if (MODULO_MODE == 9) {
        s = y.s;
        y.s = 1;
        q = div(x, y, 0, 3);
        y.s = s;
        q.s *= s;
      } else {
        q = div(x, y, 0, MODULO_MODE);
      }
      y = x.minus(q.times(y));
      if (!y.c[0] && MODULO_MODE == 1) y.s = x.s;
      return y;
    };
    P.multipliedBy = P.times = function(y, b) {
      var c, e, i, j, k, m, xcL, xlo, xhi, ycL, ylo, yhi, zc, base, sqrtBase, x = this, xc = x.c, yc = (y = new BigNumber2(y, b)).c;
      if (!xc || !yc || !xc[0] || !yc[0]) {
        if (!x.s || !y.s || xc && !xc[0] && !yc || yc && !yc[0] && !xc) {
          y.c = y.e = y.s = null;
        } else {
          y.s *= x.s;
          if (!xc || !yc) {
            y.c = y.e = null;
          } else {
            y.c = [0];
            y.e = 0;
          }
        }
        return y;
      }
      e = bitFloor(x.e / LOG_BASE) + bitFloor(y.e / LOG_BASE);
      y.s *= x.s;
      xcL = xc.length;
      ycL = yc.length;
      if (xcL < ycL) {
        zc = xc;
        xc = yc;
        yc = zc;
        i = xcL;
        xcL = ycL;
        ycL = i;
      }
      for (i = xcL + ycL, zc = []; i--; zc.push(0)) ;
      base = BASE;
      sqrtBase = SQRT_BASE;
      for (i = ycL; --i >= 0; ) {
        c = 0;
        ylo = yc[i] % sqrtBase;
        yhi = yc[i] / sqrtBase | 0;
        for (k = xcL, j = i + k; j > i; ) {
          xlo = xc[--k] % sqrtBase;
          xhi = xc[k] / sqrtBase | 0;
          m = yhi * xlo + xhi * ylo;
          xlo = ylo * xlo + m % sqrtBase * sqrtBase + zc[j] + c;
          c = (xlo / base | 0) + (m / sqrtBase | 0) + yhi * xhi;
          zc[j--] = xlo % base;
        }
        zc[j] = c;
      }
      if (c) {
        ++e;
      } else {
        zc.splice(0, 1);
      }
      return normalise(y, zc, e);
    };
    P.negated = function() {
      var x = new BigNumber2(this);
      x.s = -x.s || null;
      return x;
    };
    P.plus = function(y, b) {
      var t, x = this, a = x.s;
      y = new BigNumber2(y, b);
      b = y.s;
      if (!a || !b) return new BigNumber2(NaN);
      if (a != b) {
        y.s = -b;
        return x.minus(y);
      }
      var xe = x.e / LOG_BASE, ye = y.e / LOG_BASE, xc = x.c, yc = y.c;
      if (!xe || !ye) {
        if (!xc || !yc) return new BigNumber2(a / 0);
        if (!xc[0] || !yc[0]) return yc[0] ? y : new BigNumber2(xc[0] ? x : a * 0);
      }
      xe = bitFloor(xe);
      ye = bitFloor(ye);
      xc = xc.slice();
      if (a = xe - ye) {
        if (a > 0) {
          ye = xe;
          t = yc;
        } else {
          a = -a;
          t = xc;
        }
        t.reverse();
        for (; a--; t.push(0)) ;
        t.reverse();
      }
      a = xc.length;
      b = yc.length;
      if (a - b < 0) {
        t = yc;
        yc = xc;
        xc = t;
        b = a;
      }
      for (a = 0; b; ) {
        a = (xc[--b] = xc[b] + yc[b] + a) / BASE | 0;
        xc[b] = BASE === xc[b] ? 0 : xc[b] % BASE;
      }
      if (a) {
        xc = [a].concat(xc);
        ++ye;
      }
      return normalise(y, xc, ye);
    };
    P.precision = P.sd = function(sd, rm) {
      var c, n, v3, x = this;
      if (sd != null && sd !== !!sd) {
        intCheck(sd, 1, MAX);
        if (rm == null) rm = ROUNDING_MODE;
        else intCheck(rm, 0, 8);
        return round(new BigNumber2(x), sd, rm);
      }
      if (!(c = x.c)) return null;
      v3 = c.length - 1;
      n = v3 * LOG_BASE + 1;
      if (v3 = c[v3]) {
        for (; v3 % 10 == 0; v3 /= 10, n--) ;
        for (v3 = c[0]; v3 >= 10; v3 /= 10, n++) ;
      }
      if (sd && x.e + 1 > n) n = x.e + 1;
      return n;
    };
    P.shiftedBy = function(k) {
      intCheck(k, -MAX_SAFE_INTEGER, MAX_SAFE_INTEGER);
      return this.times("1e" + k);
    };
    P.squareRoot = P.sqrt = function() {
      var m, n, r, rep, t, x = this, c = x.c, s = x.s, e = x.e, dp = DECIMAL_PLACES + 4, half = new BigNumber2("0.5");
      if (s !== 1 || !c || !c[0]) {
        return new BigNumber2(!s || s < 0 && (!c || c[0]) ? NaN : c ? x : 1 / 0);
      }
      s = Math.sqrt(+valueOf(x));
      if (s == 0 || s == 1 / 0) {
        n = coeffToString(c);
        if ((n.length + e) % 2 == 0) n += "0";
        s = Math.sqrt(+n);
        e = bitFloor((e + 1) / 2) - (e < 0 || e % 2);
        if (s == 1 / 0) {
          n = "5e" + e;
        } else {
          n = s.toExponential();
          n = n.slice(0, n.indexOf("e") + 1) + e;
        }
        r = new BigNumber2(n);
      } else {
        r = new BigNumber2(s + "");
      }
      if (r.c[0]) {
        e = r.e;
        s = e + dp;
        if (s < 3) s = 0;
        for (; ; ) {
          t = r;
          r = half.times(t.plus(div(x, t, dp, 1)));
          if (coeffToString(t.c).slice(0, s) === (n = coeffToString(r.c)).slice(0, s)) {
            if (r.e < e) --s;
            n = n.slice(s - 3, s + 1);
            if (n == "9999" || !rep && n == "4999") {
              if (!rep) {
                round(t, t.e + DECIMAL_PLACES + 2, 0);
                if (t.times(t).eq(x)) {
                  r = t;
                  break;
                }
              }
              dp += 4;
              s += 4;
              rep = 1;
            } else {
              if (!+n || !+n.slice(1) && n.charAt(0) == "5") {
                round(r, r.e + DECIMAL_PLACES + 2, 1);
                m = !r.times(r).eq(x);
              }
              break;
            }
          }
        }
      }
      return round(r, r.e + DECIMAL_PLACES + 1, ROUNDING_MODE, m);
    };
    P.toExponential = function(dp, rm) {
      if (dp != null) {
        intCheck(dp, 0, MAX);
        dp++;
      }
      return format(this, dp, rm, 1);
    };
    P.toFixed = function(dp, rm) {
      if (dp != null) {
        intCheck(dp, 0, MAX);
        dp = dp + this.e + 1;
      }
      return format(this, dp, rm);
    };
    P.toFormat = function(dp, rm, format2) {
      var str, x = this;
      if (format2 == null) {
        if (dp != null && rm && typeof rm == "object") {
          format2 = rm;
          rm = null;
        } else if (dp && typeof dp == "object") {
          format2 = dp;
          dp = rm = null;
        } else {
          format2 = FORMAT;
        }
      } else if (typeof format2 != "object") {
        throw Error(bignumberError + "Argument not an object: " + format2);
      }
      str = x.toFixed(dp, rm);
      if (x.c) {
        var i, arr = str.split("."), g1 = +format2.groupSize, g2 = +format2.secondaryGroupSize, groupSeparator = format2.groupSeparator || "", intPart = arr[0], fractionPart = arr[1], isNeg = x.s < 0, intDigits = isNeg ? intPart.slice(1) : intPart, len = intDigits.length;
        if (g2) {
          i = g1;
          g1 = g2;
          g2 = i;
          len -= i;
        }
        if (g1 > 0 && len > 0) {
          i = len % g1 || g1;
          intPart = intDigits.substr(0, i);
          for (; i < len; i += g1) intPart += groupSeparator + intDigits.substr(i, g1);
          if (g2 > 0) intPart += groupSeparator + intDigits.slice(i);
          if (isNeg) intPart = "-" + intPart;
        }
        str = fractionPart ? intPart + (format2.decimalSeparator || "") + ((g2 = +format2.fractionGroupSize) ? fractionPart.replace(
          new RegExp("\\d{" + g2 + "}\\B", "g"),
          "$&" + (format2.fractionGroupSeparator || "")
        ) : fractionPart) : intPart;
      }
      return (format2.prefix || "") + str + (format2.suffix || "");
    };
    P.toFraction = function(md) {
      var d, d0, d1, d2, e, exp, n, n0, n1, q, r, s, x = this, xc = x.c;
      if (md != null) {
        n = new BigNumber2(md);
        if (!n.isInteger() && (n.c || n.s !== 1) || n.lt(ONE)) {
          throw Error(bignumberError + "Argument " + (n.isInteger() ? "out of range: " : "not an integer: ") + valueOf(n));
        }
      }
      if (!xc) return new BigNumber2(x);
      d = new BigNumber2(ONE);
      n1 = d0 = new BigNumber2(ONE);
      d1 = n0 = new BigNumber2(ONE);
      s = coeffToString(xc);
      e = d.e = s.length - x.e - 1;
      d.c[0] = POWS_TEN[(exp = e % LOG_BASE) < 0 ? LOG_BASE + exp : exp];
      md = !md || n.comparedTo(d) > 0 ? e > 0 ? d : n1 : n;
      exp = MAX_EXP;
      MAX_EXP = 1 / 0;
      n = new BigNumber2(s);
      n0.c[0] = 0;
      for (; ; ) {
        q = div(n, d, 0, 1);
        d2 = d0.plus(q.times(d1));
        if (d2.comparedTo(md) == 1) break;
        d0 = d1;
        d1 = d2;
        n1 = n0.plus(q.times(d2 = n1));
        n0 = d2;
        d = n.minus(q.times(d2 = d));
        n = d2;
      }
      d2 = div(md.minus(d0), d1, 0, 1);
      n0 = n0.plus(d2.times(n1));
      d0 = d0.plus(d2.times(d1));
      n0.s = n1.s = x.s;
      e = e * 2;
      r = div(n1, d1, e, ROUNDING_MODE).minus(x).abs().comparedTo(
        div(n0, d0, e, ROUNDING_MODE).minus(x).abs()
      ) < 1 ? [n1, d1] : [n0, d0];
      MAX_EXP = exp;
      return r;
    };
    P.toNumber = function() {
      return +valueOf(this);
    };
    P.toPrecision = function(sd, rm) {
      if (sd != null) intCheck(sd, 1, MAX);
      return format(this, sd, rm, 2);
    };
    P.toString = function(b) {
      var str, n = this, s = n.s, e = n.e;
      if (e === null) {
        if (s) {
          str = "Infinity";
          if (s < 0) str = "-" + str;
        } else {
          str = "NaN";
        }
      } else {
        if (b == null) {
          str = e <= TO_EXP_NEG || e >= TO_EXP_POS ? toExponential(coeffToString(n.c), e) : toFixedPoint(coeffToString(n.c), e, "0");
        } else if (b === 10 && alphabetHasNormalDecimalDigits) {
          n = round(new BigNumber2(n), DECIMAL_PLACES + e + 1, ROUNDING_MODE);
          str = toFixedPoint(coeffToString(n.c), n.e, "0");
        } else {
          intCheck(b, 2, ALPHABET.length, "Base");
          str = convertBase(toFixedPoint(coeffToString(n.c), e, "0"), 10, b, s, true);
        }
        if (s < 0 && n.c[0]) str = "-" + str;
      }
      return str;
    };
    P.valueOf = P.toJSON = function() {
      return valueOf(this);
    };
    P._isBigNumber = true;
    P[Symbol.toStringTag] = "BigNumber";
    P[/* @__PURE__ */ Symbol.for("nodejs.util.inspect.custom")] = P.valueOf;
    if (configObject != null) BigNumber2.set(configObject);
    return BigNumber2;
  }
  function bitFloor(n) {
    var i = n | 0;
    return n > 0 || n === i ? i : i - 1;
  }
  function coeffToString(a) {
    var s, z, i = 1, j = a.length, r = a[0] + "";
    for (; i < j; ) {
      s = a[i++] + "";
      z = LOG_BASE - s.length;
      for (; z--; s = "0" + s) ;
      r += s;
    }
    for (j = r.length; r.charCodeAt(--j) === 48; ) ;
    return r.slice(0, j + 1 || 1);
  }
  function compare(x, y) {
    var a, b, xc = x.c, yc = y.c, i = x.s, j = y.s, k = x.e, l = y.e;
    if (!i || !j) return null;
    a = xc && !xc[0];
    b = yc && !yc[0];
    if (a || b) return a ? b ? 0 : -j : i;
    if (i != j) return i;
    a = i < 0;
    b = k == l;
    if (!xc || !yc) return b ? 0 : !xc ^ a ? 1 : -1;
    if (!b) return k > l ^ a ? 1 : -1;
    j = (k = xc.length) < (l = yc.length) ? k : l;
    for (i = 0; i < j; i++) if (xc[i] != yc[i]) return xc[i] > yc[i] ^ a ? 1 : -1;
    return k == l ? 0 : k > l ^ a ? 1 : -1;
  }
  function intCheck(n, min, max, name) {
    if (n < min || n > max || n !== mathfloor(n)) {
      throw Error(bignumberError + (name || "Argument") + (typeof n == "number" ? n < min || n > max ? " out of range: " : " not an integer: " : " not a primitive number: ") + String(n));
    }
  }
  function isOdd(n) {
    var k = n.c.length - 1;
    return bitFloor(n.e / LOG_BASE) == k && n.c[k] % 2 != 0;
  }
  function toExponential(str, e) {
    return (str.length > 1 ? str.charAt(0) + "." + str.slice(1) : str) + (e < 0 ? "e" : "e+") + e;
  }
  function toFixedPoint(str, e, z) {
    var len, zs;
    if (e < 0) {
      for (zs = z + "."; ++e; zs += z) ;
      str = zs + str;
    } else {
      len = str.length;
      if (++e > len) {
        for (zs = z, e -= len; --e; zs += z) ;
        str += zs;
      } else if (e < len) {
        str = str.slice(0, e) + "." + str.slice(e);
      }
    }
    return str;
  }
  var BigNumber = clone();
  var bignumber_default = BigNumber;

  // node_modules/.pnpm/splaytree-ts@1.0.2/node_modules/splaytree-ts/dist/esm/index.js
  var SplayTreeNode = class {
    key;
    left = null;
    right = null;
    constructor(key) {
      this.key = key;
    }
  };
  var SplayTreeSetNode = class extends SplayTreeNode {
    constructor(key) {
      super(key);
    }
  };
  var SplayTree = class {
    size = 0;
    modificationCount = 0;
    splayCount = 0;
    splay(key) {
      const root = this.root;
      if (root == null) {
        this.compare(key, key);
        return -1;
      }
      let right = null;
      let newTreeRight = null;
      let left = null;
      let newTreeLeft = null;
      let current = root;
      const compare2 = this.compare;
      let comp;
      while (true) {
        comp = compare2(current.key, key);
        if (comp > 0) {
          let currentLeft = current.left;
          if (currentLeft == null) break;
          comp = compare2(currentLeft.key, key);
          if (comp > 0) {
            current.left = currentLeft.right;
            currentLeft.right = current;
            current = currentLeft;
            currentLeft = current.left;
            if (currentLeft == null) break;
          }
          if (right == null) {
            newTreeRight = current;
          } else {
            right.left = current;
          }
          right = current;
          current = currentLeft;
        } else if (comp < 0) {
          let currentRight = current.right;
          if (currentRight == null) break;
          comp = compare2(currentRight.key, key);
          if (comp < 0) {
            current.right = currentRight.left;
            currentRight.left = current;
            current = currentRight;
            currentRight = current.right;
            if (currentRight == null) break;
          }
          if (left == null) {
            newTreeLeft = current;
          } else {
            left.right = current;
          }
          left = current;
          current = currentRight;
        } else {
          break;
        }
      }
      if (left != null) {
        left.right = current.left;
        current.left = newTreeLeft;
      }
      if (right != null) {
        right.left = current.right;
        current.right = newTreeRight;
      }
      if (this.root !== current) {
        this.root = current;
        this.splayCount++;
      }
      return comp;
    }
    splayMin(node) {
      let current = node;
      let nextLeft = current.left;
      while (nextLeft != null) {
        const left = nextLeft;
        current.left = left.right;
        left.right = current;
        current = left;
        nextLeft = current.left;
      }
      return current;
    }
    splayMax(node) {
      let current = node;
      let nextRight = current.right;
      while (nextRight != null) {
        const right = nextRight;
        current.right = right.left;
        right.left = current;
        current = right;
        nextRight = current.right;
      }
      return current;
    }
    _delete(key) {
      if (this.root == null) return null;
      const comp = this.splay(key);
      if (comp != 0) return null;
      let root = this.root;
      const result = root;
      const left = root.left;
      this.size--;
      if (left == null) {
        this.root = root.right;
      } else {
        const right = root.right;
        root = this.splayMax(left);
        root.right = right;
        this.root = root;
      }
      this.modificationCount++;
      return result;
    }
    addNewRoot(node, comp) {
      this.size++;
      this.modificationCount++;
      const root = this.root;
      if (root == null) {
        this.root = node;
        return;
      }
      if (comp < 0) {
        node.left = root;
        node.right = root.right;
        root.right = null;
      } else {
        node.right = root;
        node.left = root.left;
        root.left = null;
      }
      this.root = node;
    }
    _first() {
      const root = this.root;
      if (root == null) return null;
      this.root = this.splayMin(root);
      return this.root;
    }
    _last() {
      const root = this.root;
      if (root == null) return null;
      this.root = this.splayMax(root);
      return this.root;
    }
    clear() {
      this.root = null;
      this.size = 0;
      this.modificationCount++;
    }
    has(key) {
      return this.validKey(key) && this.splay(key) == 0;
    }
    defaultCompare() {
      return (a, b) => a < b ? -1 : a > b ? 1 : 0;
    }
    wrap() {
      return {
        getRoot: () => {
          return this.root;
        },
        setRoot: (root) => {
          this.root = root;
        },
        getSize: () => {
          return this.size;
        },
        getModificationCount: () => {
          return this.modificationCount;
        },
        getSplayCount: () => {
          return this.splayCount;
        },
        setSplayCount: (count) => {
          this.splayCount = count;
        },
        splay: (key) => {
          return this.splay(key);
        },
        has: (key) => {
          return this.has(key);
        }
      };
    }
  };
  var SplayTreeSet = class _SplayTreeSet extends SplayTree {
    root = null;
    compare;
    validKey;
    constructor(compare2, isValidKey) {
      super();
      this.compare = compare2 ?? this.defaultCompare();
      this.validKey = isValidKey ?? ((v3) => v3 != null && v3 != void 0);
    }
    delete(element) {
      if (!this.validKey(element)) return false;
      return this._delete(element) != null;
    }
    deleteAll(elements) {
      for (const element of elements) {
        this.delete(element);
      }
    }
    forEach(f) {
      const nodes = this[Symbol.iterator]();
      let result;
      while (result = nodes.next(), !result.done) {
        f(result.value, result.value, this);
      }
    }
    add(element) {
      const compare2 = this.splay(element);
      if (compare2 != 0) this.addNewRoot(new SplayTreeSetNode(element), compare2);
      return this;
    }
    addAndReturn(element) {
      const compare2 = this.splay(element);
      if (compare2 != 0) this.addNewRoot(new SplayTreeSetNode(element), compare2);
      return this.root.key;
    }
    addAll(elements) {
      for (const element of elements) {
        this.add(element);
      }
    }
    isEmpty() {
      return this.root == null;
    }
    isNotEmpty() {
      return this.root != null;
    }
    single() {
      if (this.size == 0) throw "Bad state: No element";
      if (this.size > 1) throw "Bad state: Too many element";
      return this.root.key;
    }
    first() {
      if (this.size == 0) throw "Bad state: No element";
      return this._first().key;
    }
    last() {
      if (this.size == 0) throw "Bad state: No element";
      return this._last().key;
    }
    lastBefore(element) {
      if (element == null) throw "Invalid arguments(s)";
      if (this.root == null) return null;
      const comp = this.splay(element);
      if (comp < 0) return this.root.key;
      let node = this.root.left;
      if (node == null) return null;
      let nodeRight = node.right;
      while (nodeRight != null) {
        node = nodeRight;
        nodeRight = node.right;
      }
      return node.key;
    }
    firstAfter(element) {
      if (element == null) throw "Invalid arguments(s)";
      if (this.root == null) return null;
      const comp = this.splay(element);
      if (comp > 0) return this.root.key;
      let node = this.root.right;
      if (node == null) return null;
      let nodeLeft = node.left;
      while (nodeLeft != null) {
        node = nodeLeft;
        nodeLeft = node.left;
      }
      return node.key;
    }
    retainAll(elements) {
      const retainSet = new _SplayTreeSet(this.compare, this.validKey);
      const modificationCount = this.modificationCount;
      for (const object of elements) {
        if (modificationCount != this.modificationCount) {
          throw "Concurrent modification during iteration.";
        }
        if (this.validKey(object) && this.splay(object) == 0) {
          retainSet.add(this.root.key);
        }
      }
      if (retainSet.size != this.size) {
        this.root = retainSet.root;
        this.size = retainSet.size;
        this.modificationCount++;
      }
    }
    lookup(object) {
      if (!this.validKey(object)) return null;
      const comp = this.splay(object);
      if (comp != 0) return null;
      return this.root.key;
    }
    intersection(other) {
      const result = new _SplayTreeSet(this.compare, this.validKey);
      for (const element of this) {
        if (other.has(element)) result.add(element);
      }
      return result;
    }
    difference(other) {
      const result = new _SplayTreeSet(this.compare, this.validKey);
      for (const element of this) {
        if (!other.has(element)) result.add(element);
      }
      return result;
    }
    union(other) {
      const u7 = this.clone();
      u7.addAll(other);
      return u7;
    }
    clone() {
      const set2 = new _SplayTreeSet(this.compare, this.validKey);
      set2.size = this.size;
      set2.root = this.copyNode(this.root);
      return set2;
    }
    copyNode(node) {
      if (node == null) return null;
      function copyChildren(node2, dest) {
        let left;
        let right;
        do {
          left = node2.left;
          right = node2.right;
          if (left != null) {
            const newLeft = new SplayTreeSetNode(left.key);
            dest.left = newLeft;
            copyChildren(left, newLeft);
          }
          if (right != null) {
            const newRight = new SplayTreeSetNode(right.key);
            dest.right = newRight;
            node2 = right;
            dest = newRight;
          }
        } while (right != null);
      }
      const result = new SplayTreeSetNode(node.key);
      copyChildren(node, result);
      return result;
    }
    toSet() {
      return this.clone();
    }
    entries() {
      return new SplayTreeSetEntryIterableIterator(this.wrap());
    }
    keys() {
      return this[Symbol.iterator]();
    }
    values() {
      return this[Symbol.iterator]();
    }
    [Symbol.iterator]() {
      return new SplayTreeKeyIterableIterator(this.wrap());
    }
    [Symbol.toStringTag] = "[object Set]";
  };
  var SplayTreeIterableIterator = class {
    tree;
    path = new Array();
    modificationCount = null;
    splayCount;
    constructor(tree) {
      this.tree = tree;
      this.splayCount = tree.getSplayCount();
    }
    [Symbol.iterator]() {
      return this;
    }
    next() {
      if (this.moveNext()) return { done: false, value: this.current() };
      return { done: true, value: null };
    }
    current() {
      if (!this.path.length) return null;
      const node = this.path[this.path.length - 1];
      return this.getValue(node);
    }
    rebuildPath(key) {
      this.path.splice(0, this.path.length);
      this.tree.splay(key);
      this.path.push(this.tree.getRoot());
      this.splayCount = this.tree.getSplayCount();
    }
    findLeftMostDescendent(node) {
      while (node != null) {
        this.path.push(node);
        node = node.left;
      }
    }
    moveNext() {
      if (this.modificationCount != this.tree.getModificationCount()) {
        if (this.modificationCount == null) {
          this.modificationCount = this.tree.getModificationCount();
          let node2 = this.tree.getRoot();
          while (node2 != null) {
            this.path.push(node2);
            node2 = node2.left;
          }
          return this.path.length > 0;
        }
        throw "Concurrent modification during iteration.";
      }
      if (!this.path.length) return false;
      if (this.splayCount != this.tree.getSplayCount()) {
        this.rebuildPath(this.path[this.path.length - 1].key);
      }
      let node = this.path[this.path.length - 1];
      let next = node.right;
      if (next != null) {
        while (next != null) {
          this.path.push(next);
          next = next.left;
        }
        return true;
      }
      this.path.pop();
      while (this.path.length && this.path[this.path.length - 1].right === node) {
        node = this.path.pop();
      }
      return this.path.length > 0;
    }
  };
  var SplayTreeKeyIterableIterator = class extends SplayTreeIterableIterator {
    getValue(node) {
      return node.key;
    }
  };
  var SplayTreeSetEntryIterableIterator = class extends SplayTreeIterableIterator {
    getValue(node) {
      return [node.key, node.key];
    }
  };

  // node_modules/.pnpm/polyclip-ts@0.16.8/node_modules/polyclip-ts/dist/esm/index.js
  var constant_default = (x) => {
    return () => {
      return x;
    };
  };
  var compare_default = (eps) => {
    const almostEqual = eps ? (a, b) => b.minus(a).abs().isLessThanOrEqualTo(eps) : constant_default(false);
    return (a, b) => {
      if (almostEqual(a, b)) return 0;
      return a.comparedTo(b);
    };
  };
  function orient_default(eps) {
    const almostCollinear = eps ? (area2, ax, ay, cx, cy) => area2.exponentiatedBy(2).isLessThanOrEqualTo(
      cx.minus(ax).exponentiatedBy(2).plus(cy.minus(ay).exponentiatedBy(2)).times(eps)
    ) : constant_default(false);
    return (a, b, c) => {
      const ax = a.x, ay = a.y, cx = c.x, cy = c.y;
      const area2 = ay.minus(cy).times(b.x.minus(cx)).minus(ax.minus(cx).times(b.y.minus(cy)));
      if (almostCollinear(area2, ax, ay, cx, cy)) return 0;
      return area2.comparedTo(0);
    };
  }
  var identity_default = (x) => {
    return x;
  };
  var snap_default = (eps) => {
    if (eps) {
      const xTree = new SplayTreeSet(compare_default(eps));
      const yTree = new SplayTreeSet(compare_default(eps));
      const snapCoord = (coord, tree) => {
        return tree.addAndReturn(coord);
      };
      const snap = (v3) => {
        return {
          x: snapCoord(v3.x, xTree),
          y: snapCoord(v3.y, yTree)
        };
      };
      snap({ x: new bignumber_default(0), y: new bignumber_default(0) });
      return snap;
    }
    return identity_default;
  };
  var set = (eps) => {
    return {
      set: (eps2) => {
        precision = set(eps2);
      },
      reset: () => set(eps),
      compare: compare_default(eps),
      snap: snap_default(eps),
      orient: orient_default(eps)
    };
  };
  var precision = set();
  var isInBbox = (bbox3, point2) => {
    return bbox3.ll.x.isLessThanOrEqualTo(point2.x) && point2.x.isLessThanOrEqualTo(bbox3.ur.x) && bbox3.ll.y.isLessThanOrEqualTo(point2.y) && point2.y.isLessThanOrEqualTo(bbox3.ur.y);
  };
  var getBboxOverlap = (b1, b2) => {
    if (b2.ur.x.isLessThan(b1.ll.x) || b1.ur.x.isLessThan(b2.ll.x) || b2.ur.y.isLessThan(b1.ll.y) || b1.ur.y.isLessThan(b2.ll.y))
      return null;
    const lowerX = b1.ll.x.isLessThan(b2.ll.x) ? b2.ll.x : b1.ll.x;
    const upperX = b1.ur.x.isLessThan(b2.ur.x) ? b1.ur.x : b2.ur.x;
    const lowerY = b1.ll.y.isLessThan(b2.ll.y) ? b2.ll.y : b1.ll.y;
    const upperY = b1.ur.y.isLessThan(b2.ur.y) ? b1.ur.y : b2.ur.y;
    return { ll: { x: lowerX, y: lowerY }, ur: { x: upperX, y: upperY } };
  };
  var crossProduct = (a, b) => a.x.times(b.y).minus(a.y.times(b.x));
  var dotProduct = (a, b) => a.x.times(b.x).plus(a.y.times(b.y));
  var length = (v3) => dotProduct(v3, v3).sqrt();
  var sineOfAngle = (pShared, pBase, pAngle) => {
    const vBase = { x: pBase.x.minus(pShared.x), y: pBase.y.minus(pShared.y) };
    const vAngle = { x: pAngle.x.minus(pShared.x), y: pAngle.y.minus(pShared.y) };
    return crossProduct(vAngle, vBase).div(length(vAngle)).div(length(vBase));
  };
  var cosineOfAngle = (pShared, pBase, pAngle) => {
    const vBase = { x: pBase.x.minus(pShared.x), y: pBase.y.minus(pShared.y) };
    const vAngle = { x: pAngle.x.minus(pShared.x), y: pAngle.y.minus(pShared.y) };
    return dotProduct(vAngle, vBase).div(length(vAngle)).div(length(vBase));
  };
  var horizontalIntersection = (pt2, v3, y) => {
    if (v3.y.isZero()) return null;
    return { x: pt2.x.plus(v3.x.div(v3.y).times(y.minus(pt2.y))), y };
  };
  var verticalIntersection = (pt2, v3, x) => {
    if (v3.x.isZero()) return null;
    return { x, y: pt2.y.plus(v3.y.div(v3.x).times(x.minus(pt2.x))) };
  };
  var intersection = (pt1, v1, pt2, v22) => {
    if (v1.x.isZero()) return verticalIntersection(pt2, v22, pt1.x);
    if (v22.x.isZero()) return verticalIntersection(pt1, v1, pt2.x);
    if (v1.y.isZero()) return horizontalIntersection(pt2, v22, pt1.y);
    if (v22.y.isZero()) return horizontalIntersection(pt1, v1, pt2.y);
    const kross = crossProduct(v1, v22);
    if (kross.isZero()) return null;
    const ve = { x: pt2.x.minus(pt1.x), y: pt2.y.minus(pt1.y) };
    const d1 = crossProduct(ve, v1).div(kross);
    const d2 = crossProduct(ve, v22).div(kross);
    const x1 = pt1.x.plus(d2.times(v1.x)), x2 = pt2.x.plus(d1.times(v22.x));
    const y1 = pt1.y.plus(d2.times(v1.y)), y2 = pt2.y.plus(d1.times(v22.y));
    const x = x1.plus(x2).div(2);
    const y = y1.plus(y2).div(2);
    return { x, y };
  };
  var SweepEvent = class _SweepEvent {
    point;
    isLeft;
    segment;
    otherSE;
    consumedBy;
    // for ordering sweep events in the sweep event queue
    static compare(a, b) {
      const ptCmp = _SweepEvent.comparePoints(a.point, b.point);
      if (ptCmp !== 0) return ptCmp;
      if (a.point !== b.point) a.link(b);
      if (a.isLeft !== b.isLeft) return a.isLeft ? 1 : -1;
      return Segment2.compare(a.segment, b.segment);
    }
    // for ordering points in sweep line order
    static comparePoints(aPt, bPt) {
      if (aPt.x.isLessThan(bPt.x)) return -1;
      if (aPt.x.isGreaterThan(bPt.x)) return 1;
      if (aPt.y.isLessThan(bPt.y)) return -1;
      if (aPt.y.isGreaterThan(bPt.y)) return 1;
      return 0;
    }
    // Warning: 'point' input will be modified and re-used (for performance)
    constructor(point2, isLeft) {
      if (point2.events === void 0) point2.events = [this];
      else point2.events.push(this);
      this.point = point2;
      this.isLeft = isLeft;
    }
    link(other) {
      if (other.point === this.point) {
        throw new Error("Tried to link already linked events");
      }
      const otherEvents = other.point.events;
      for (let i = 0, iMax = otherEvents.length; i < iMax; i++) {
        const evt = otherEvents[i];
        this.point.events.push(evt);
        evt.point = this.point;
      }
      this.checkForConsuming();
    }
    /* Do a pass over our linked events and check to see if any pair
     * of segments match, and should be consumed. */
    checkForConsuming() {
      const numEvents = this.point.events.length;
      for (let i = 0; i < numEvents; i++) {
        const evt1 = this.point.events[i];
        if (evt1.segment.consumedBy !== void 0) continue;
        for (let j = i + 1; j < numEvents; j++) {
          const evt2 = this.point.events[j];
          if (evt2.consumedBy !== void 0) continue;
          if (evt1.otherSE.point.events !== evt2.otherSE.point.events) continue;
          evt1.segment.consume(evt2.segment);
        }
      }
    }
    getAvailableLinkedEvents() {
      const events = [];
      for (let i = 0, iMax = this.point.events.length; i < iMax; i++) {
        const evt = this.point.events[i];
        if (evt !== this && !evt.segment.ringOut && evt.segment.isInResult()) {
          events.push(evt);
        }
      }
      return events;
    }
    /**
     * Returns a comparator function for sorting linked events that will
     * favor the event that will give us the smallest left-side angle.
     * All ring construction starts as low as possible heading to the right,
     * so by always turning left as sharp as possible we'll get polygons
     * without uncessary loops & holes.
     *
     * The comparator function has a compute cache such that it avoids
     * re-computing already-computed values.
     */
    getLeftmostComparator(baseEvent) {
      const cache = /* @__PURE__ */ new Map();
      const fillCache = (linkedEvent) => {
        const nextEvent = linkedEvent.otherSE;
        cache.set(linkedEvent, {
          sine: sineOfAngle(this.point, baseEvent.point, nextEvent.point),
          cosine: cosineOfAngle(this.point, baseEvent.point, nextEvent.point)
        });
      };
      return (a, b) => {
        if (!cache.has(a)) fillCache(a);
        if (!cache.has(b)) fillCache(b);
        const { sine: asine, cosine: acosine } = cache.get(a);
        const { sine: bsine, cosine: bcosine } = cache.get(b);
        if (asine.isGreaterThanOrEqualTo(0) && bsine.isGreaterThanOrEqualTo(0)) {
          if (acosine.isLessThan(bcosine)) return 1;
          if (acosine.isGreaterThan(bcosine)) return -1;
          return 0;
        }
        if (asine.isLessThan(0) && bsine.isLessThan(0)) {
          if (acosine.isLessThan(bcosine)) return -1;
          if (acosine.isGreaterThan(bcosine)) return 1;
          return 0;
        }
        if (bsine.isLessThan(asine)) return -1;
        if (bsine.isGreaterThan(asine)) return 1;
        return 0;
      };
    }
  };
  var RingOut = class _RingOut {
    events;
    poly;
    _isExteriorRing;
    _enclosingRing;
    /* Given the segments from the sweep line pass, compute & return a series
     * of closed rings from all the segments marked to be part of the result */
    static factory(allSegments) {
      const ringsOut = [];
      for (let i = 0, iMax = allSegments.length; i < iMax; i++) {
        const segment = allSegments[i];
        if (!segment.isInResult() || segment.ringOut) continue;
        let prevEvent = null;
        let event = segment.leftSE;
        let nextEvent = segment.rightSE;
        const events = [event];
        const startingPoint = event.point;
        const intersectionLEs = [];
        while (true) {
          prevEvent = event;
          event = nextEvent;
          events.push(event);
          if (event.point === startingPoint) break;
          while (true) {
            const availableLEs = event.getAvailableLinkedEvents();
            if (availableLEs.length === 0) {
              const firstPt = events[0].point;
              const lastPt = events[events.length - 1].point;
              throw new Error(
                `Unable to complete output ring starting at [${firstPt.x}, ${firstPt.y}]. Last matching segment found ends at [${lastPt.x}, ${lastPt.y}].`
              );
            }
            if (availableLEs.length === 1) {
              nextEvent = availableLEs[0].otherSE;
              break;
            }
            let indexLE = null;
            for (let j = 0, jMax = intersectionLEs.length; j < jMax; j++) {
              if (intersectionLEs[j].point === event.point) {
                indexLE = j;
                break;
              }
            }
            if (indexLE !== null) {
              const intersectionLE = intersectionLEs.splice(indexLE)[0];
              const ringEvents = events.splice(intersectionLE.index);
              ringEvents.unshift(ringEvents[0].otherSE);
              ringsOut.push(new _RingOut(ringEvents.reverse()));
              continue;
            }
            intersectionLEs.push({
              index: events.length,
              point: event.point
            });
            const comparator = event.getLeftmostComparator(prevEvent);
            nextEvent = availableLEs.sort(comparator)[0].otherSE;
            break;
          }
        }
        ringsOut.push(new _RingOut(events));
      }
      return ringsOut;
    }
    constructor(events) {
      this.events = events;
      for (let i = 0, iMax = events.length; i < iMax; i++) {
        events[i].segment.ringOut = this;
      }
      this.poly = null;
    }
    getGeom() {
      let prevPt = this.events[0].point;
      const points = [prevPt];
      for (let i = 1, iMax = this.events.length - 1; i < iMax; i++) {
        const pt22 = this.events[i].point;
        const nextPt2 = this.events[i + 1].point;
        if (precision.orient(pt22, prevPt, nextPt2) === 0) continue;
        points.push(pt22);
        prevPt = pt22;
      }
      if (points.length === 1) return null;
      const pt2 = points[0];
      const nextPt = points[1];
      if (precision.orient(pt2, prevPt, nextPt) === 0) points.shift();
      points.push(points[0]);
      const step = this.isExteriorRing() ? 1 : -1;
      const iStart = this.isExteriorRing() ? 0 : points.length - 1;
      const iEnd = this.isExteriorRing() ? points.length : -1;
      const orderedPoints = [];
      for (let i = iStart; i != iEnd; i += step)
        orderedPoints.push([points[i].x.toNumber(), points[i].y.toNumber()]);
      return orderedPoints;
    }
    isExteriorRing() {
      if (this._isExteriorRing === void 0) {
        const enclosing = this.enclosingRing();
        this._isExteriorRing = enclosing ? !enclosing.isExteriorRing() : true;
      }
      return this._isExteriorRing;
    }
    enclosingRing() {
      if (this._enclosingRing === void 0) {
        this._enclosingRing = this._calcEnclosingRing();
      }
      return this._enclosingRing;
    }
    /* Returns the ring that encloses this one, if any */
    _calcEnclosingRing() {
      let leftMostEvt = this.events[0];
      for (let i = 1, iMax = this.events.length; i < iMax; i++) {
        const evt = this.events[i];
        if (SweepEvent.compare(leftMostEvt, evt) > 0) leftMostEvt = evt;
      }
      let prevSeg = leftMostEvt.segment.prevInResult();
      let prevPrevSeg = prevSeg ? prevSeg.prevInResult() : null;
      while (true) {
        if (!prevSeg) return null;
        if (!prevPrevSeg) return prevSeg.ringOut;
        if (prevPrevSeg.ringOut !== prevSeg.ringOut) {
          if (prevPrevSeg.ringOut?.enclosingRing() !== prevSeg.ringOut) {
            return prevSeg.ringOut;
          } else return prevSeg.ringOut?.enclosingRing();
        }
        prevSeg = prevPrevSeg.prevInResult();
        prevPrevSeg = prevSeg ? prevSeg.prevInResult() : null;
      }
    }
  };
  var PolyOut = class {
    exteriorRing;
    interiorRings;
    constructor(exteriorRing) {
      this.exteriorRing = exteriorRing;
      exteriorRing.poly = this;
      this.interiorRings = [];
    }
    addInterior(ring) {
      this.interiorRings.push(ring);
      ring.poly = this;
    }
    getGeom() {
      const geom0 = this.exteriorRing.getGeom();
      if (geom0 === null) return null;
      const geom = [geom0];
      for (let i = 0, iMax = this.interiorRings.length; i < iMax; i++) {
        const ringGeom = this.interiorRings[i].getGeom();
        if (ringGeom === null) continue;
        geom.push(ringGeom);
      }
      return geom;
    }
  };
  var MultiPolyOut = class {
    rings;
    polys;
    constructor(rings) {
      this.rings = rings;
      this.polys = this._composePolys(rings);
    }
    getGeom() {
      const geom = [];
      for (let i = 0, iMax = this.polys.length; i < iMax; i++) {
        const polyGeom = this.polys[i].getGeom();
        if (polyGeom === null) continue;
        geom.push(polyGeom);
      }
      return geom;
    }
    _composePolys(rings) {
      const polys = [];
      for (let i = 0, iMax = rings.length; i < iMax; i++) {
        const ring = rings[i];
        if (ring.poly) continue;
        if (ring.isExteriorRing()) polys.push(new PolyOut(ring));
        else {
          const enclosingRing = ring.enclosingRing();
          if (!enclosingRing?.poly) polys.push(new PolyOut(enclosingRing));
          enclosingRing?.poly?.addInterior(ring);
        }
      }
      return polys;
    }
  };
  var SweepLine = class {
    queue;
    tree;
    segments;
    constructor(queue, comparator = Segment2.compare) {
      this.queue = queue;
      this.tree = new SplayTreeSet(comparator);
      this.segments = [];
    }
    process(event) {
      const segment = event.segment;
      const newEvents = [];
      if (event.consumedBy) {
        if (event.isLeft) this.queue.delete(event.otherSE);
        else this.tree.delete(segment);
        return newEvents;
      }
      if (event.isLeft) this.tree.add(segment);
      let prevSeg = segment;
      let nextSeg = segment;
      do {
        prevSeg = this.tree.lastBefore(prevSeg);
      } while (prevSeg != null && prevSeg.consumedBy != void 0);
      do {
        nextSeg = this.tree.firstAfter(nextSeg);
      } while (nextSeg != null && nextSeg.consumedBy != void 0);
      if (event.isLeft) {
        let prevMySplitter = null;
        if (prevSeg) {
          const prevInter = prevSeg.getIntersection(segment);
          if (prevInter !== null) {
            if (!segment.isAnEndpoint(prevInter)) prevMySplitter = prevInter;
            if (!prevSeg.isAnEndpoint(prevInter)) {
              const newEventsFromSplit = this._splitSafely(prevSeg, prevInter);
              for (let i = 0, iMax = newEventsFromSplit.length; i < iMax; i++) {
                newEvents.push(newEventsFromSplit[i]);
              }
            }
          }
        }
        let nextMySplitter = null;
        if (nextSeg) {
          const nextInter = nextSeg.getIntersection(segment);
          if (nextInter !== null) {
            if (!segment.isAnEndpoint(nextInter)) nextMySplitter = nextInter;
            if (!nextSeg.isAnEndpoint(nextInter)) {
              const newEventsFromSplit = this._splitSafely(nextSeg, nextInter);
              for (let i = 0, iMax = newEventsFromSplit.length; i < iMax; i++) {
                newEvents.push(newEventsFromSplit[i]);
              }
            }
          }
        }
        if (prevMySplitter !== null || nextMySplitter !== null) {
          let mySplitter = null;
          if (prevMySplitter === null) mySplitter = nextMySplitter;
          else if (nextMySplitter === null) mySplitter = prevMySplitter;
          else {
            const cmpSplitters = SweepEvent.comparePoints(
              prevMySplitter,
              nextMySplitter
            );
            mySplitter = cmpSplitters <= 0 ? prevMySplitter : nextMySplitter;
          }
          this.queue.delete(segment.rightSE);
          newEvents.push(segment.rightSE);
          const newEventsFromSplit = segment.split(mySplitter);
          for (let i = 0, iMax = newEventsFromSplit.length; i < iMax; i++) {
            newEvents.push(newEventsFromSplit[i]);
          }
        }
        if (newEvents.length > 0) {
          this.tree.delete(segment);
          newEvents.push(event);
        } else {
          this.segments.push(segment);
          segment.prev = prevSeg;
        }
      } else {
        if (prevSeg && nextSeg) {
          const inter = prevSeg.getIntersection(nextSeg);
          if (inter !== null) {
            if (!prevSeg.isAnEndpoint(inter)) {
              const newEventsFromSplit = this._splitSafely(prevSeg, inter);
              for (let i = 0, iMax = newEventsFromSplit.length; i < iMax; i++) {
                newEvents.push(newEventsFromSplit[i]);
              }
            }
            if (!nextSeg.isAnEndpoint(inter)) {
              const newEventsFromSplit = this._splitSafely(nextSeg, inter);
              for (let i = 0, iMax = newEventsFromSplit.length; i < iMax; i++) {
                newEvents.push(newEventsFromSplit[i]);
              }
            }
          }
        }
        this.tree.delete(segment);
      }
      return newEvents;
    }
    /* Safely split a segment that is currently in the datastructures
     * IE - a segment other than the one that is currently being processed. */
    _splitSafely(seg, pt2) {
      this.tree.delete(seg);
      const rightSE = seg.rightSE;
      this.queue.delete(rightSE);
      const newEvents = seg.split(pt2);
      newEvents.push(rightSE);
      if (seg.consumedBy === void 0) this.tree.add(seg);
      return newEvents;
    }
  };
  var Operation = class {
    type;
    numMultiPolys;
    run(type, geom, moreGeoms) {
      operation.type = type;
      const multipolys = [new MultiPolyIn(geom, true)];
      for (let i = 0, iMax = moreGeoms.length; i < iMax; i++) {
        multipolys.push(new MultiPolyIn(moreGeoms[i], false));
      }
      operation.numMultiPolys = multipolys.length;
      if (operation.type === "difference") {
        const subject = multipolys[0];
        let i = 1;
        while (i < multipolys.length) {
          if (getBboxOverlap(multipolys[i].bbox, subject.bbox) !== null) i++;
          else multipolys.splice(i, 1);
        }
      }
      if (operation.type === "intersection") {
        for (let i = 0, iMax = multipolys.length; i < iMax; i++) {
          const mpA = multipolys[i];
          for (let j = i + 1, jMax = multipolys.length; j < jMax; j++) {
            if (getBboxOverlap(mpA.bbox, multipolys[j].bbox) === null) return [];
          }
        }
      }
      const queue = new SplayTreeSet(SweepEvent.compare);
      for (let i = 0, iMax = multipolys.length; i < iMax; i++) {
        const sweepEvents = multipolys[i].getSweepEvents();
        for (let j = 0, jMax = sweepEvents.length; j < jMax; j++) {
          queue.add(sweepEvents[j]);
        }
      }
      const sweepLine = new SweepLine(queue);
      let evt = null;
      if (queue.size != 0) {
        evt = queue.first();
        queue.delete(evt);
      }
      while (evt) {
        const newEvents = sweepLine.process(evt);
        for (let i = 0, iMax = newEvents.length; i < iMax; i++) {
          const evt2 = newEvents[i];
          if (evt2.consumedBy === void 0) queue.add(evt2);
        }
        if (queue.size != 0) {
          evt = queue.first();
          queue.delete(evt);
        } else {
          evt = null;
        }
      }
      precision.reset();
      const ringsOut = RingOut.factory(sweepLine.segments);
      const result = new MultiPolyOut(ringsOut);
      return result.getGeom();
    }
  };
  var operation = new Operation();
  var operation_default = operation;
  var segmentId = 0;
  var Segment2 = class _Segment {
    id;
    leftSE;
    rightSE;
    rings;
    windings;
    ringOut;
    consumedBy;
    prev;
    _prevInResult;
    _beforeState;
    _afterState;
    _isInResult;
    /* This compare() function is for ordering segments in the sweep
     * line tree, and does so according to the following criteria:
     *
     * Consider the vertical line that lies an infinestimal step to the
     * right of the right-more of the two left endpoints of the input
     * segments. Imagine slowly moving a point up from negative infinity
     * in the increasing y direction. Which of the two segments will that
     * point intersect first? That segment comes 'before' the other one.
     *
     * If neither segment would be intersected by such a line, (if one
     * or more of the segments are vertical) then the line to be considered
     * is directly on the right-more of the two left inputs.
     */
    static compare(a, b) {
      const alx = a.leftSE.point.x;
      const blx = b.leftSE.point.x;
      const arx = a.rightSE.point.x;
      const brx = b.rightSE.point.x;
      if (brx.isLessThan(alx)) return 1;
      if (arx.isLessThan(blx)) return -1;
      const aly = a.leftSE.point.y;
      const bly = b.leftSE.point.y;
      const ary = a.rightSE.point.y;
      const bry = b.rightSE.point.y;
      if (alx.isLessThan(blx)) {
        if (bly.isLessThan(aly) && bly.isLessThan(ary)) return 1;
        if (bly.isGreaterThan(aly) && bly.isGreaterThan(ary)) return -1;
        const aCmpBLeft = a.comparePoint(b.leftSE.point);
        if (aCmpBLeft < 0) return 1;
        if (aCmpBLeft > 0) return -1;
        const bCmpARight = b.comparePoint(a.rightSE.point);
        if (bCmpARight !== 0) return bCmpARight;
        return -1;
      }
      if (alx.isGreaterThan(blx)) {
        if (aly.isLessThan(bly) && aly.isLessThan(bry)) return -1;
        if (aly.isGreaterThan(bly) && aly.isGreaterThan(bry)) return 1;
        const bCmpALeft = b.comparePoint(a.leftSE.point);
        if (bCmpALeft !== 0) return bCmpALeft;
        const aCmpBRight = a.comparePoint(b.rightSE.point);
        if (aCmpBRight < 0) return 1;
        if (aCmpBRight > 0) return -1;
        return 1;
      }
      if (aly.isLessThan(bly)) return -1;
      if (aly.isGreaterThan(bly)) return 1;
      if (arx.isLessThan(brx)) {
        const bCmpARight = b.comparePoint(a.rightSE.point);
        if (bCmpARight !== 0) return bCmpARight;
      }
      if (arx.isGreaterThan(brx)) {
        const aCmpBRight = a.comparePoint(b.rightSE.point);
        if (aCmpBRight < 0) return 1;
        if (aCmpBRight > 0) return -1;
      }
      if (!arx.eq(brx)) {
        const ay = ary.minus(aly);
        const ax = arx.minus(alx);
        const by = bry.minus(bly);
        const bx = brx.minus(blx);
        if (ay.isGreaterThan(ax) && by.isLessThan(bx)) return 1;
        if (ay.isLessThan(ax) && by.isGreaterThan(bx)) return -1;
      }
      if (arx.isGreaterThan(brx)) return 1;
      if (arx.isLessThan(brx)) return -1;
      if (ary.isLessThan(bry)) return -1;
      if (ary.isGreaterThan(bry)) return 1;
      if (a.id < b.id) return -1;
      if (a.id > b.id) return 1;
      return 0;
    }
    /* Warning: a reference to ringWindings input will be stored,
     *  and possibly will be later modified */
    constructor(leftSE, rightSE, rings, windings) {
      this.id = ++segmentId;
      this.leftSE = leftSE;
      leftSE.segment = this;
      leftSE.otherSE = rightSE;
      this.rightSE = rightSE;
      rightSE.segment = this;
      rightSE.otherSE = leftSE;
      this.rings = rings;
      this.windings = windings;
    }
    static fromRing(pt1, pt2, ring) {
      let leftPt, rightPt, winding;
      const cmpPts = SweepEvent.comparePoints(pt1, pt2);
      if (cmpPts < 0) {
        leftPt = pt1;
        rightPt = pt2;
        winding = 1;
      } else if (cmpPts > 0) {
        leftPt = pt2;
        rightPt = pt1;
        winding = -1;
      } else
        throw new Error(
          `Tried to create degenerate segment at [${pt1.x}, ${pt1.y}]`
        );
      const leftSE = new SweepEvent(leftPt, true);
      const rightSE = new SweepEvent(rightPt, false);
      return new _Segment(leftSE, rightSE, [ring], [winding]);
    }
    /* When a segment is split, the rightSE is replaced with a new sweep event */
    replaceRightSE(newRightSE) {
      this.rightSE = newRightSE;
      this.rightSE.segment = this;
      this.rightSE.otherSE = this.leftSE;
      this.leftSE.otherSE = this.rightSE;
    }
    bbox() {
      const y1 = this.leftSE.point.y;
      const y2 = this.rightSE.point.y;
      return {
        ll: { x: this.leftSE.point.x, y: y1.isLessThan(y2) ? y1 : y2 },
        ur: { x: this.rightSE.point.x, y: y1.isGreaterThan(y2) ? y1 : y2 }
      };
    }
    /* A vector from the left point to the right */
    vector() {
      return {
        x: this.rightSE.point.x.minus(this.leftSE.point.x),
        y: this.rightSE.point.y.minus(this.leftSE.point.y)
      };
    }
    isAnEndpoint(pt2) {
      return pt2.x.eq(this.leftSE.point.x) && pt2.y.eq(this.leftSE.point.y) || pt2.x.eq(this.rightSE.point.x) && pt2.y.eq(this.rightSE.point.y);
    }
    /* Compare this segment with a point.
     *
     * A point P is considered to be colinear to a segment if there
     * exists a distance D such that if we travel along the segment
     * from one * endpoint towards the other a distance D, we find
     * ourselves at point P.
     *
     * Return value indicates:
     *
     *   1: point lies above the segment (to the left of vertical)
     *   0: point is colinear to segment
     *  -1: point lies below the segment (to the right of vertical)
     */
    comparePoint(point2) {
      return precision.orient(this.leftSE.point, point2, this.rightSE.point);
    }
    /**
     * Given another segment, returns the first non-trivial intersection
     * between the two segments (in terms of sweep line ordering), if it exists.
     *
     * A 'non-trivial' intersection is one that will cause one or both of the
     * segments to be split(). As such, 'trivial' vs. 'non-trivial' intersection:
     *
     *   * endpoint of segA with endpoint of segB --> trivial
     *   * endpoint of segA with point along segB --> non-trivial
     *   * endpoint of segB with point along segA --> non-trivial
     *   * point along segA with point along segB --> non-trivial
     *
     * If no non-trivial intersection exists, return null
     * Else, return null.
     */
    getIntersection(other) {
      const tBbox = this.bbox();
      const oBbox = other.bbox();
      const bboxOverlap = getBboxOverlap(tBbox, oBbox);
      if (bboxOverlap === null) return null;
      const tlp = this.leftSE.point;
      const trp = this.rightSE.point;
      const olp = other.leftSE.point;
      const orp = other.rightSE.point;
      const touchesOtherLSE = isInBbox(tBbox, olp) && this.comparePoint(olp) === 0;
      const touchesThisLSE = isInBbox(oBbox, tlp) && other.comparePoint(tlp) === 0;
      const touchesOtherRSE = isInBbox(tBbox, orp) && this.comparePoint(orp) === 0;
      const touchesThisRSE = isInBbox(oBbox, trp) && other.comparePoint(trp) === 0;
      if (touchesThisLSE && touchesOtherLSE) {
        if (touchesThisRSE && !touchesOtherRSE) return trp;
        if (!touchesThisRSE && touchesOtherRSE) return orp;
        return null;
      }
      if (touchesThisLSE) {
        if (touchesOtherRSE) {
          if (tlp.x.eq(orp.x) && tlp.y.eq(orp.y)) return null;
        }
        return tlp;
      }
      if (touchesOtherLSE) {
        if (touchesThisRSE) {
          if (trp.x.eq(olp.x) && trp.y.eq(olp.y)) return null;
        }
        return olp;
      }
      if (touchesThisRSE && touchesOtherRSE) return null;
      if (touchesThisRSE) return trp;
      if (touchesOtherRSE) return orp;
      const pt2 = intersection(tlp, this.vector(), olp, other.vector());
      if (pt2 === null) return null;
      if (!isInBbox(bboxOverlap, pt2)) return null;
      return precision.snap(pt2);
    }
    /**
     * Split the given segment into multiple segments on the given points.
     *  * Each existing segment will retain its leftSE and a new rightSE will be
     *    generated for it.
     *  * A new segment will be generated which will adopt the original segment's
     *    rightSE, and a new leftSE will be generated for it.
     *  * If there are more than two points given to split on, new segments
     *    in the middle will be generated with new leftSE and rightSE's.
     *  * An array of the newly generated SweepEvents will be returned.
     *
     * Warning: input array of points is modified
     */
    split(point2) {
      const newEvents = [];
      const alreadyLinked = point2.events !== void 0;
      const newLeftSE = new SweepEvent(point2, true);
      const newRightSE = new SweepEvent(point2, false);
      const oldRightSE = this.rightSE;
      this.replaceRightSE(newRightSE);
      newEvents.push(newRightSE);
      newEvents.push(newLeftSE);
      const newSeg = new _Segment(
        newLeftSE,
        oldRightSE,
        this.rings.slice(),
        this.windings.slice()
      );
      if (SweepEvent.comparePoints(newSeg.leftSE.point, newSeg.rightSE.point) > 0) {
        newSeg.swapEvents();
      }
      if (SweepEvent.comparePoints(this.leftSE.point, this.rightSE.point) > 0) {
        this.swapEvents();
      }
      if (alreadyLinked) {
        newLeftSE.checkForConsuming();
        newRightSE.checkForConsuming();
      }
      return newEvents;
    }
    /* Swap which event is left and right */
    swapEvents() {
      const tmpEvt = this.rightSE;
      this.rightSE = this.leftSE;
      this.leftSE = tmpEvt;
      this.leftSE.isLeft = true;
      this.rightSE.isLeft = false;
      for (let i = 0, iMax = this.windings.length; i < iMax; i++) {
        this.windings[i] *= -1;
      }
    }
    /* Consume another segment. We take their rings under our wing
     * and mark them as consumed. Use for perfectly overlapping segments */
    consume(other) {
      let consumer = this;
      let consumee = other;
      while (consumer.consumedBy) consumer = consumer.consumedBy;
      while (consumee.consumedBy) consumee = consumee.consumedBy;
      const cmp = _Segment.compare(consumer, consumee);
      if (cmp === 0) return;
      if (cmp > 0) {
        const tmp = consumer;
        consumer = consumee;
        consumee = tmp;
      }
      if (consumer.prev === consumee) {
        const tmp = consumer;
        consumer = consumee;
        consumee = tmp;
      }
      for (let i = 0, iMax = consumee.rings.length; i < iMax; i++) {
        const ring = consumee.rings[i];
        const winding = consumee.windings[i];
        const index = consumer.rings.indexOf(ring);
        if (index === -1) {
          consumer.rings.push(ring);
          consumer.windings.push(winding);
        } else consumer.windings[index] += winding;
      }
      consumee.rings = null;
      consumee.windings = null;
      consumee.consumedBy = consumer;
      consumee.leftSE.consumedBy = consumer.leftSE;
      consumee.rightSE.consumedBy = consumer.rightSE;
    }
    /* The first segment previous segment chain that is in the result */
    prevInResult() {
      if (this._prevInResult !== void 0) return this._prevInResult;
      if (!this.prev) this._prevInResult = null;
      else if (this.prev.isInResult()) this._prevInResult = this.prev;
      else this._prevInResult = this.prev.prevInResult();
      return this._prevInResult;
    }
    beforeState() {
      if (this._beforeState !== void 0) return this._beforeState;
      if (!this.prev)
        this._beforeState = {
          rings: [],
          windings: [],
          multiPolys: []
        };
      else {
        const seg = this.prev.consumedBy || this.prev;
        this._beforeState = seg.afterState();
      }
      return this._beforeState;
    }
    afterState() {
      if (this._afterState !== void 0) return this._afterState;
      const beforeState = this.beforeState();
      this._afterState = {
        rings: beforeState.rings.slice(0),
        windings: beforeState.windings.slice(0),
        multiPolys: []
      };
      const ringsAfter = this._afterState.rings;
      const windingsAfter = this._afterState.windings;
      const mpsAfter = this._afterState.multiPolys;
      for (let i = 0, iMax = this.rings.length; i < iMax; i++) {
        const ring = this.rings[i];
        const winding = this.windings[i];
        const index = ringsAfter.indexOf(ring);
        if (index === -1) {
          ringsAfter.push(ring);
          windingsAfter.push(winding);
        } else windingsAfter[index] += winding;
      }
      const polysAfter = [];
      const polysExclude = [];
      for (let i = 0, iMax = ringsAfter.length; i < iMax; i++) {
        if (windingsAfter[i] === 0) continue;
        const ring = ringsAfter[i];
        const poly = ring.poly;
        if (polysExclude.indexOf(poly) !== -1) continue;
        if (ring.isExterior) polysAfter.push(poly);
        else {
          if (polysExclude.indexOf(poly) === -1) polysExclude.push(poly);
          const index = polysAfter.indexOf(ring.poly);
          if (index !== -1) polysAfter.splice(index, 1);
        }
      }
      for (let i = 0, iMax = polysAfter.length; i < iMax; i++) {
        const mp = polysAfter[i].multiPoly;
        if (mpsAfter.indexOf(mp) === -1) mpsAfter.push(mp);
      }
      return this._afterState;
    }
    /* Is this segment part of the final result? */
    isInResult() {
      if (this.consumedBy) return false;
      if (this._isInResult !== void 0) return this._isInResult;
      const mpsBefore = this.beforeState().multiPolys;
      const mpsAfter = this.afterState().multiPolys;
      switch (operation_default.type) {
        case "union": {
          const noBefores = mpsBefore.length === 0;
          const noAfters = mpsAfter.length === 0;
          this._isInResult = noBefores !== noAfters;
          break;
        }
        case "intersection": {
          let least;
          let most;
          if (mpsBefore.length < mpsAfter.length) {
            least = mpsBefore.length;
            most = mpsAfter.length;
          } else {
            least = mpsAfter.length;
            most = mpsBefore.length;
          }
          this._isInResult = most === operation_default.numMultiPolys && least < most;
          break;
        }
        case "xor": {
          const diff = Math.abs(mpsBefore.length - mpsAfter.length);
          this._isInResult = diff % 2 === 1;
          break;
        }
        case "difference": {
          const isJustSubject = (mps) => mps.length === 1 && mps[0].isSubject;
          this._isInResult = isJustSubject(mpsBefore) !== isJustSubject(mpsAfter);
          break;
        }
      }
      return this._isInResult;
    }
  };
  var RingIn = class {
    poly;
    isExterior;
    segments;
    bbox;
    constructor(geomRing, poly, isExterior) {
      if (!Array.isArray(geomRing) || geomRing.length === 0) {
        throw new Error("Input geometry is not a valid Polygon or MultiPolygon");
      }
      this.poly = poly;
      this.isExterior = isExterior;
      this.segments = [];
      if (typeof geomRing[0][0] !== "number" || typeof geomRing[0][1] !== "number") {
        throw new Error("Input geometry is not a valid Polygon or MultiPolygon");
      }
      const firstPoint = precision.snap({ x: new bignumber_default(geomRing[0][0]), y: new bignumber_default(geomRing[0][1]) });
      this.bbox = {
        ll: { x: firstPoint.x, y: firstPoint.y },
        ur: { x: firstPoint.x, y: firstPoint.y }
      };
      let prevPoint = firstPoint;
      for (let i = 1, iMax = geomRing.length; i < iMax; i++) {
        if (typeof geomRing[i][0] !== "number" || typeof geomRing[i][1] !== "number") {
          throw new Error("Input geometry is not a valid Polygon or MultiPolygon");
        }
        const point2 = precision.snap({ x: new bignumber_default(geomRing[i][0]), y: new bignumber_default(geomRing[i][1]) });
        if (point2.x.eq(prevPoint.x) && point2.y.eq(prevPoint.y)) continue;
        this.segments.push(Segment2.fromRing(prevPoint, point2, this));
        if (point2.x.isLessThan(this.bbox.ll.x)) this.bbox.ll.x = point2.x;
        if (point2.y.isLessThan(this.bbox.ll.y)) this.bbox.ll.y = point2.y;
        if (point2.x.isGreaterThan(this.bbox.ur.x)) this.bbox.ur.x = point2.x;
        if (point2.y.isGreaterThan(this.bbox.ur.y)) this.bbox.ur.y = point2.y;
        prevPoint = point2;
      }
      if (!firstPoint.x.eq(prevPoint.x) || !firstPoint.y.eq(prevPoint.y)) {
        this.segments.push(Segment2.fromRing(prevPoint, firstPoint, this));
      }
    }
    getSweepEvents() {
      const sweepEvents = [];
      for (let i = 0, iMax = this.segments.length; i < iMax; i++) {
        const segment = this.segments[i];
        sweepEvents.push(segment.leftSE);
        sweepEvents.push(segment.rightSE);
      }
      return sweepEvents;
    }
  };
  var PolyIn = class {
    multiPoly;
    exteriorRing;
    interiorRings;
    bbox;
    constructor(geomPoly, multiPoly) {
      if (!Array.isArray(geomPoly)) {
        throw new Error("Input geometry is not a valid Polygon or MultiPolygon");
      }
      this.exteriorRing = new RingIn(geomPoly[0], this, true);
      this.bbox = {
        ll: { x: this.exteriorRing.bbox.ll.x, y: this.exteriorRing.bbox.ll.y },
        ur: { x: this.exteriorRing.bbox.ur.x, y: this.exteriorRing.bbox.ur.y }
      };
      this.interiorRings = [];
      for (let i = 1, iMax = geomPoly.length; i < iMax; i++) {
        const ring = new RingIn(geomPoly[i], this, false);
        if (ring.bbox.ll.x.isLessThan(this.bbox.ll.x)) this.bbox.ll.x = ring.bbox.ll.x;
        if (ring.bbox.ll.y.isLessThan(this.bbox.ll.y)) this.bbox.ll.y = ring.bbox.ll.y;
        if (ring.bbox.ur.x.isGreaterThan(this.bbox.ur.x)) this.bbox.ur.x = ring.bbox.ur.x;
        if (ring.bbox.ur.y.isGreaterThan(this.bbox.ur.y)) this.bbox.ur.y = ring.bbox.ur.y;
        this.interiorRings.push(ring);
      }
      this.multiPoly = multiPoly;
    }
    getSweepEvents() {
      const sweepEvents = this.exteriorRing.getSweepEvents();
      for (let i = 0, iMax = this.interiorRings.length; i < iMax; i++) {
        const ringSweepEvents = this.interiorRings[i].getSweepEvents();
        for (let j = 0, jMax = ringSweepEvents.length; j < jMax; j++) {
          sweepEvents.push(ringSweepEvents[j]);
        }
      }
      return sweepEvents;
    }
  };
  var MultiPolyIn = class {
    isSubject;
    polys;
    bbox;
    constructor(geom, isSubject) {
      if (!Array.isArray(geom)) {
        throw new Error("Input geometry is not a valid Polygon or MultiPolygon");
      }
      try {
        if (typeof geom[0][0][0] === "number") geom = [geom];
      } catch (ex) {
      }
      this.polys = [];
      this.bbox = {
        ll: { x: new bignumber_default(Number.POSITIVE_INFINITY), y: new bignumber_default(Number.POSITIVE_INFINITY) },
        ur: { x: new bignumber_default(Number.NEGATIVE_INFINITY), y: new bignumber_default(Number.NEGATIVE_INFINITY) }
      };
      for (let i = 0, iMax = geom.length; i < iMax; i++) {
        const poly = new PolyIn(geom[i], this);
        if (poly.bbox.ll.x.isLessThan(this.bbox.ll.x)) this.bbox.ll.x = poly.bbox.ll.x;
        if (poly.bbox.ll.y.isLessThan(this.bbox.ll.y)) this.bbox.ll.y = poly.bbox.ll.y;
        if (poly.bbox.ur.x.isGreaterThan(this.bbox.ur.x)) this.bbox.ur.x = poly.bbox.ur.x;
        if (poly.bbox.ur.y.isGreaterThan(this.bbox.ur.y)) this.bbox.ur.y = poly.bbox.ur.y;
        this.polys.push(poly);
      }
      this.isSubject = isSubject;
    }
    getSweepEvents() {
      const sweepEvents = [];
      for (let i = 0, iMax = this.polys.length; i < iMax; i++) {
        const polySweepEvents = this.polys[i].getSweepEvents();
        for (let j = 0, jMax = polySweepEvents.length; j < jMax; j++) {
          sweepEvents.push(polySweepEvents[j]);
        }
      }
      return sweepEvents;
    }
  };
  var intersection2 = (geom, ...moreGeoms) => operation_default.run("intersection", geom, moreGeoms);
  var difference = (geom, ...moreGeoms) => operation_default.run("difference", geom, moreGeoms);
  var setPrecision = precision.set;

  // src/js/helpers/turfHelper.ts
  function feature2(geom) {
    const feat = { type: "Feature" };
    feat.geometry = geom;
    return feat;
  }
  function getGeometry(geojson) {
    if (geojson.type === "Feature") return geojson.geometry;
    return geojson;
  }
  function getCoords2(geojson) {
    if (geojson && geojson.geometry && geojson.geometry.coordinates)
      return geojson.geometry.coordinates;
    return geojson;
  }
  function turfLineString(coords) {
    return feature2({ type: "LineString", coordinates: coords });
  }
  function turfMultiLineString(coords) {
    return feature2({ type: "MultiLineString", coordinates: coords });
  }
  function turfPolygon(coords) {
    return feature2({ type: "Polygon", coordinates: coords });
  }
  function turfMultiPolygon(coords) {
    return feature2({ type: "MultiPolygon", coordinates: coords });
  }
  function intersect(poly1, poly2) {
    const geom1 = getGeometry(poly1);
    const geom2 = getGeometry(poly2);
    const intersection3 = intersection2(
      geom1.coordinates,
      geom2.coordinates
    );
    if (intersection3.length === 0) return null;
    if (intersection3.length === 1) return turfPolygon(intersection3[0]);
    return turfMultiPolygon(intersection3);
  }
  function difference2(polygon1, polygon2) {
    const geom1 = getGeometry(polygon1);
    const geom2 = getGeometry(polygon2);
    const differenced = difference(
      geom1.coordinates,
      geom2.coordinates
    );
    if (differenced.length === 0) return null;
    if (differenced.length === 1) return turfPolygon(differenced[0]);
    return turfMultiPolygon(differenced);
  }
  function getDepthOfCoords(coords) {
    if (Array.isArray(coords)) {
      return 1 + getDepthOfCoords(coords[0]);
    }
    return -1;
  }
  function flattenPolyline(polyline) {
    if (polyline instanceof L.Polyline) {
      polyline = polyline.toGeoJSON(15);
    }
    const coords = getCoords2(polyline);
    const depth = getDepthOfCoords(coords);
    const features = [];
    if (depth > 1) {
      coords.forEach((coord) => {
        features.push(turfLineString(coord));
      });
    } else {
      features.push(polyline);
    }
    return features;
  }
  function groupToMultiLineString(group) {
    const coords = [];
    group.eachLayer((layer) => {
      coords.push(getCoords2(layer.toGeoJSON(15)));
    });
    return turfMultiLineString(coords);
  }

  // src/js/Draw/L.PM.Draw.Cut.ts
  L_PM_Draw_default.Cut = L_PM_Draw_default.Polygon.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Cut";
      this.toolbarButtonName = "cutPolygon";
    },
    _finishShape() {
      this._editedLayers = [];
      if (!this.options.allowSelfIntersection) {
        this._handleSelfIntersection(
          true,
          this._layer.getLatLngs()[0]
        );
        if (this._doesSelfIntersect) {
          return;
        }
      }
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      const coords = this._layer.getLatLngs();
      if (coords.length <= 2) {
        return;
      }
      const polygonLayer = L.polygon(coords, this.options.pathOptions);
      polygonLayer._latlngInfos = this._layer._latlngInfo;
      this.cut(polygonLayer);
      this._cleanupSnapping();
      this._otherSnapLayers.splice(this._tempSnapLayerIndex, 1);
      delete this._tempSnapLayerIndex;
      this._editedLayers.forEach(({ layer, originalLayer }) => {
        this._fireCut(originalLayer, layer, originalLayer);
        this._fireCut(this._map, layer, originalLayer);
        originalLayer.pm._fireEdit();
      });
      this._editedLayers = [];
      const hintMarkerLatLng = this._hintMarker.getLatLng();
      this.disable();
      if (this.options.continueDrawing) {
        this.enable();
        this._hintMarker.setLatLng(hintMarkerLatLng);
      }
    },
    cut(layer) {
      const all = this._map._layers;
      const _latlngInfos = layer._latlngInfos || [];
      const layers = Object.keys(all).map((l) => all[l]).filter((l) => l.pm).filter((l) => !l._pmTempLayer).filter(
        (l) => !L.PM.optIn && !l.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
        L.PM.optIn && l.options.pmIgnore === false
        // if optIn is true and pmIgnore is false);
      ).filter((l) => l instanceof L.Polyline).filter((l) => l !== layer).filter((l) => l.pm.options.allowCutting).filter((l) => {
        if (this.options.layersToCut && L.Util.isArray(this.options.layersToCut) && this.options.layersToCut.length > 0) {
          return this.options.layersToCut.indexOf(l) > -1;
        }
        return true;
      }).filter((l) => !this._layerGroup.hasLayer(l)).filter((l) => {
        try {
          const lineInter = !!index_default2(layer.toGeoJSON(15), l.toGeoJSON(15)).features.length > 0;
          if (lineInter || l instanceof L.Polyline && !(l instanceof L.Polygon)) {
            return lineInter;
          }
          return !!intersect(layer.toGeoJSON(15), l.toGeoJSON(15));
        } catch (e) {
          if (l instanceof L.Polygon) {
            console.error("You can't cut polygons with self-intersections");
          }
          return false;
        }
      });
      layers.forEach((l) => {
        let newLayer;
        if (l instanceof L.Polygon) {
          newLayer = L.polygon(l.getLatLngs());
          const coords = newLayer.getLatLngs();
          _latlngInfos.forEach((info) => {
            if (info && info.snapInfo) {
              const { latlng } = info;
              const closest = this._calcClosestLayer(latlng, [newLayer]);
              if (closest && closest.segment && closest.distance < this.options.snapDistance) {
                const { segment } = closest;
                if (segment && segment.length === 2) {
                  const { indexPath, parentPath, newIndex } = L.PM.Utils._getIndexFromSegment(coords, segment);
                  const coordsRing = indexPath.length > 1 ? (0, import_get2.default)(coords, parentPath) : coords;
                  coordsRing.splice(newIndex, 0, latlng);
                }
              }
            }
          });
        } else {
          newLayer = l;
        }
        const diff = this._cutLayer(layer, newLayer);
        let resultLayer = L.geoJSON(diff, l.options);
        if (resultLayer.getLayers().length === 1) {
          [resultLayer] = resultLayer.getLayers();
        }
        this._setPane(resultLayer, "layerPane");
        const resultingLayer = resultLayer.addTo(
          this._map.pm._getContainingLayer()
        );
        resultingLayer.pm.enable(l.pm.options);
        resultingLayer.pm.disable();
        l._pmTempLayer = true;
        layer._pmTempLayer = true;
        l.remove();
        l.removeFrom(this._map.pm._getContainingLayer());
        layer.remove();
        layer.removeFrom(this._map.pm._getContainingLayer());
        if (resultingLayer.getLayers && resultingLayer.getLayers().length === 0) {
          this._map.pm.removeLayer({ target: resultingLayer });
        }
        if (resultingLayer instanceof L.LayerGroup) {
          resultingLayer.eachLayer((_layer) => {
            this._addDrawnLayerProp(_layer);
          });
          this._addDrawnLayerProp(resultingLayer);
        } else {
          this._addDrawnLayerProp(resultingLayer);
        }
        if (this.options.layersToCut && L.Util.isArray(this.options.layersToCut) && this.options.layersToCut.length > 0) {
          const idx = this.options.layersToCut.indexOf(l);
          if (idx > -1) {
            this.options.layersToCut.splice(idx, 1);
          }
        }
        this._editedLayers.push({
          layer: resultingLayer,
          originalLayer: l
        });
      });
    },
    _cutLayer(layer, l) {
      const fg = L.geoJSON();
      let diff;
      if (l instanceof L.Polygon) {
        diff = difference2(l.toGeoJSON(15), layer.toGeoJSON(15));
      } else {
        const features = flattenPolyline(l);
        features.forEach((feature3) => {
          const lineDiff = index_default3(
            feature3,
            layer.toGeoJSON(15)
          );
          let group;
          if (lineDiff && lineDiff.features.length > 0) {
            group = L.geoJSON(lineDiff);
          } else {
            group = L.geoJSON(feature3);
          }
          group.getLayers().forEach((lay) => {
            if (!index_default4(
              layer.toGeoJSON(15),
              lay.toGeoJSON(15)
            )) {
              lay.addTo(fg);
            }
          });
        });
        if (features.length > 1) {
          diff = groupToMultiLineString(fg);
        } else {
          diff = fg.toGeoJSON(15);
        }
      }
      return diff;
    },
    _change: L.Util.falseFn
  });

  // src/js/Draw/L.PM.Draw.Text.ts
  L_PM_Draw_default.Text = L_PM_Draw_default.extend({
    initialize(map) {
      this._map = map;
      this._shape = "Text";
      this.toolbarButtonName = "drawText";
    },
    enable(options) {
      L.Util.setOptions(this, options);
      this._enabled = true;
      this._map.on("click", this._createMarker, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, true);
      this._hintMarker = L.marker(this._map.getCenter(), {
        interactive: false,
        zIndexOffset: 100,
        icon: L.divIcon({ className: "marker-icon cursor-marker" })
      });
      this._setPane(this._hintMarker, "vertexPane");
      this._hintMarker._pmTempLayer = true;
      this._hintMarker.addTo(this._map);
      if (this.options.cursorMarker) {
        L.DomUtil.addClass(this._hintMarker._icon, "visible");
      }
      if (this.options.tooltips) {
        this._hintMarker.bindTooltip(getTranslation("tooltips.placeText"), {
          permanent: true,
          offset: L.point(0, 10),
          direction: "bottom",
          opacity: 0.8
        }).openTooltip();
      }
      this._layer = this._hintMarker;
      this._map.on("mousemove", this._syncHintMarker, this);
      this._map.getContainer().classList.add("geoman-draw-cursor");
      this._fireDrawStart();
      this._setGlobalDrawMode();
    },
    disable() {
      if (!this._enabled) {
        return;
      }
      this._enabled = false;
      this._map.off("click", this._createMarker, this);
      this._hintMarker?.remove();
      this._map.getContainer().classList.remove("geoman-draw-cursor");
      this._map.off("mousemove", this._syncHintMarker, this);
      this._map.off("mousemove", this._showHintMarkerAfterMoving, this);
      this._map.pm.Toolbar.toggleButton(this.toolbarButtonName, false);
      if (this.options.snappable) {
        this._cleanupSnapping();
      }
      this._fireDrawEnd();
      this._setGlobalDrawMode();
    },
    enabled() {
      return this._enabled;
    },
    toggle(options) {
      if (this.enabled()) {
        this.disable();
      } else {
        this.enable(options);
      }
    },
    _syncHintMarker(e) {
      this._hintMarker.setLatLng(e.latlng);
      if (this.options.snappable) {
        const fakeDragEvent = e;
        fakeDragEvent.target = this._hintMarker;
        this._handleSnapping(fakeDragEvent);
      }
    },
    _createMarker(e) {
      if (!e.latlng) {
        return;
      }
      if (this.options.requireSnapToFinish && !this._hintMarker._snapped && !this._isFirstLayer()) {
        return;
      }
      if (!this._hintMarker._snapped) {
        this._hintMarker.setLatLng(e.latlng);
      }
      const latlng = this._hintMarker.getLatLng();
      this.textArea = this._createTextArea();
      if (this.options.textOptions?.className) {
        const cssClasses = this.options.textOptions.className.split(" ");
        this.textArea.classList.add(...cssClasses);
      }
      const textAreaIcon = this._createTextIcon(this.textArea);
      const marker = new L.Marker(latlng, {
        textMarker: true,
        _textMarkerOverPM: true,
        // we need to put this into the options, else we can't catch this in the init method
        icon: textAreaIcon
      });
      this._setPane(marker, "markerPane");
      this._finishLayer(marker);
      if (!marker.pm) {
        marker.options.draggable = false;
      }
      marker.addTo(this._map.pm._getContainingLayer());
      if (marker.pm) {
        marker.pm.textArea = this.textArea;
        L.setOptions(marker.pm, {
          removeIfEmpty: this.options.textOptions?.removeIfEmpty ?? true
        });
        const focusAfterDraw = this.options.textOptions?.focusAfterDraw ?? true;
        marker.pm._createTextMarker(focusAfterDraw);
        if (this.options.textOptions?.text) {
          marker.pm.setText(this.options.textOptions.text);
        }
      }
      this._fireCreate(marker);
      this._cleanupSnapping();
      this.disable();
      if (this.options.continueDrawing) {
        this._map.once("mousemove", this._showHintMarkerAfterMoving, this);
      }
    },
    _showHintMarkerAfterMoving(e) {
      this.enable();
      this._hintMarker.setLatLng(e.latlng);
    },
    _createTextArea() {
      const textArea = document.createElement("textarea");
      textArea.readOnly = true;
      textArea.classList.add("pm-textarea", "pm-disabled");
      return textArea;
    },
    _createTextIcon(textArea) {
      return L.divIcon({
        className: "pm-text-marker",
        html: textArea
      });
    }
  });

  // src/js/Mixins/Dragging.ts
  var DragMixin = {
    enableLayerDrag() {
      if (!this.options.draggable || !this._layer._map) {
        return;
      }
      this.disable();
      this._layerDragEnabled = true;
      if (!this._map) {
        this._map = this._layer._map;
      }
      if (this._layer instanceof L.Marker || this._layer instanceof L.ImageOverlay) {
        L.DomEvent.on(this._getDOMElem(), "dragstart", this._stopDOMImageDrag);
      }
      if (this._layer.dragging) {
        this._layer.dragging.disable();
      }
      this._tempDragCoord = null;
      if (getRenderer(this._layer) instanceof L.Canvas) {
        this._layer.on("mouseout", this.removeDraggingClass, this);
        this._layer.on("mouseover", this.addDraggingClass, this);
      } else {
        this.addDraggingClass();
      }
      this._originalMapDragState = this._layer._map.dragging._enabled;
      this._safeToCacheDragState = true;
      const container = this._getDOMElem();
      if (container) {
        if (getRenderer(this._layer) instanceof L.Canvas) {
          this._layer.on(
            "touchstart mousedown",
            this._dragMixinOnMouseDown,
            this
          );
          this._map.pm._addTouchEvents(container);
        } else {
          L.DomEvent.on(
            container,
            "touchstart mousedown",
            this._simulateMouseDownEvent,
            this
          );
        }
      }
      this._fireDragEnable();
    },
    disableLayerDrag() {
      this._layerDragEnabled = false;
      if (getRenderer(this._layer) instanceof L.Canvas) {
        this._layer.off("mouseout", this.removeDraggingClass, this);
        this._layer.off("mouseover", this.addDraggingClass, this);
      } else {
        this.removeDraggingClass();
      }
      if (this._originalMapDragState && this._dragging) {
        this._map.dragging.enable();
      }
      this._safeToCacheDragState = false;
      if (this._layer.dragging) {
        this._layer.dragging.disable();
      }
      const container = this._getDOMElem();
      if (container) {
        if (getRenderer(this._layer) instanceof L.Canvas) {
          this._layer.off(
            "touchstart mousedown",
            this._dragMixinOnMouseDown,
            this
          );
          this._map.pm._removeTouchEvents(container);
        } else {
          L.DomEvent.off(
            container,
            "touchstart mousedown",
            this._simulateMouseDownEvent,
            this
          );
        }
      }
      if (this._layerDragged) {
        this._fireUpdate();
      }
      this._layerDragged = false;
      this._fireDragDisable();
    },
    // TODO: make this private in the next major release
    dragging() {
      return this._dragging;
    },
    layerDragEnabled() {
      return !!this._layerDragEnabled;
    },
    // We need to simulate a mousedown event on the layer object. We can't just use layer.on('mousedown') because on touch devices the event is not fired if user presses on the layer and then drag it.
    // With checking on touchstart and mousedown on the DOM element we can listen on the needed events
    _simulateMouseDownEvent(e) {
      const first = e.touches ? e.touches[0] : e;
      const evt = {
        originalEvent: first,
        target: this._layer
      };
      evt.containerPoint = this._map.mouseEventToContainerPoint(first);
      evt.latlng = this._map.containerPointToLatLng(evt.containerPoint);
      this._dragMixinOnMouseDown(evt);
      return false;
    },
    _simulateMouseMoveEvent(e) {
      const first = e.touches ? e.touches[0] : e;
      const evt = {
        originalEvent: first,
        target: this._layer
      };
      evt.containerPoint = this._map.mouseEventToContainerPoint(first);
      evt.latlng = this._map.containerPointToLatLng(evt.containerPoint);
      this._dragMixinOnMouseMove(evt);
      return false;
    },
    _simulateMouseUpEvent(e) {
      const first = e.touches ? e.touches[0] : e;
      const evt = {
        originalEvent: first,
        target: this._layer
      };
      if (e.type.indexOf("touch") === -1) {
        evt.containerPoint = this._map.mouseEventToContainerPoint(e);
        evt.latlng = this._map.containerPointToLatLng(evt.containerPoint);
      }
      this._dragMixinOnMouseUp(evt);
      return false;
    },
    _dragMixinOnMouseDown(e) {
      if (e.originalEvent.button > 0) {
        return;
      }
      this._overwriteEventIfItComesFromMarker(e);
      const fromLayerSync = e._fromLayerSync;
      const layersToSyncFound = this._syncLayers("_dragMixinOnMouseDown", e);
      if (this._layer instanceof L.Marker) {
        if (this.options.snappable && !fromLayerSync && !layersToSyncFound) {
          this._initSnappableMarkers();
        } else {
          this._disableSnapping();
        }
      }
      if (this._layer instanceof L.CircleMarker) {
        let _editableOption = "resizeableCircleMarker";
        if (this._layer instanceof L.Circle) {
          _editableOption = "resizeableCircle";
        }
        if (this.options.snappable && !fromLayerSync && !layersToSyncFound) {
          if (!this._layer.pm.options[_editableOption]) {
            this._initSnappableMarkersDrag();
          }
        } else if (this._layer.pm.options[_editableOption]) {
          this._layer.pm._disableSnapping();
        } else {
          this._layer.pm._disableSnappingDrag();
        }
      }
      if (this._safeToCacheDragState) {
        this._originalMapDragState = this._layer._map.dragging._enabled;
        this._safeToCacheDragState = false;
      }
      this._tempDragCoord = e.latlng;
      L.DomEvent.on(
        this._map.getContainer(),
        "touchend mouseup",
        this._simulateMouseUpEvent,
        this
      );
      L.DomEvent.on(
        this._map.getContainer(),
        "touchmove mousemove",
        this._simulateMouseMoveEvent,
        this
      );
    },
    _dragMixinOnMouseMove(e) {
      this._overwriteEventIfItComesFromMarker(e);
      const el = this._getDOMElem();
      this._syncLayers("_dragMixinOnMouseMove", e);
      if (!this._dragging) {
        this._dragging = true;
        L.DomUtil.addClass(el, "leaflet-pm-dragging");
        if (!(this._layer instanceof L.Marker)) {
          this._layer.bringToFront();
        }
        if (this._originalMapDragState) {
          this._map.dragging.disable();
        }
        this._fireDragStart();
      }
      if (!this._tempDragCoord) {
        this._tempDragCoord = e.latlng;
      }
      this._onLayerDrag(e);
      if (this._layer instanceof L.CircleMarker) {
        this._layer.pm._updateHiddenPolyCircle();
      }
    },
    _dragMixinOnMouseUp(e) {
      const el = this._getDOMElem();
      this._syncLayers("_dragMixinOnMouseUp", e);
      if (this._originalMapDragState) {
        this._map.dragging.enable();
      }
      this._safeToCacheDragState = true;
      L.DomEvent.off(
        this._map.getContainer(),
        "touchmove mousemove",
        this._simulateMouseMoveEvent,
        this
      );
      L.DomEvent.off(
        this._map.getContainer(),
        "touchend mouseup",
        this._simulateMouseUpEvent,
        this
      );
      if (!this._dragging) {
        return false;
      }
      if (this._layer instanceof L.CircleMarker) {
        this._layer.pm._updateHiddenPolyCircle();
      }
      this._layerDragged = true;
      window.setTimeout(() => {
        this._dragging = false;
        if (el) {
          L.DomUtil.removeClass(el, "leaflet-pm-dragging");
        }
        this._fireDragEnd();
        this._fireEdit();
        this._layerEdited = true;
      }, 10);
      return true;
    },
    _onLayerDrag(e) {
      const { latlng } = e;
      const deltaLatLng = {
        lat: latlng.lat - this._tempDragCoord.lat,
        lng: latlng.lng - this._tempDragCoord.lng
      };
      const moveCoords = (coords) => (
        // alter the coordinates
        coords.map((currentLatLng) => {
          if (Array.isArray(currentLatLng)) {
            return moveCoords(currentLatLng);
          }
          const newLatlng = {
            lat: currentLatLng.lat + deltaLatLng.lat,
            lng: currentLatLng.lng + deltaLatLng.lng
          };
          if (currentLatLng.alt || currentLatLng.alt === 0) {
            newLatlng.alt = currentLatLng.alt;
          }
          return newLatlng;
        })
      );
      if (this._layer instanceof L.Circle && this._layer.options.resizeableCircle || this._layer instanceof L.CircleMarker && this._layer.options.resizeableCircleMarker) {
        const newCoords = moveCoords([this._layer.getLatLng()]);
        this._layer.setLatLng(newCoords[0]);
        this._fireChange(this._layer.getLatLng(), "Edit");
      } else if (this._layer instanceof L.CircleMarker || this._layer instanceof L.Marker) {
        let coordsRefernce = this._layer.getLatLng();
        if (this._layer._snapped) {
          coordsRefernce = this._layer._orgLatLng;
        }
        const newCoords = moveCoords([coordsRefernce]);
        this._layer.setLatLng(newCoords[0]);
        this._fireChange(this._layer.getLatLng(), "Edit");
      } else if (this._layer instanceof L.ImageOverlay) {
        const newCoords = moveCoords([
          this._layer.getBounds().getNorthWest(),
          this._layer.getBounds().getSouthEast()
        ]);
        this._layer.setBounds(newCoords);
        this._fireChange(this._layer.getBounds(), "Edit");
      } else {
        const newCoords = moveCoords(this._layer.getLatLngs());
        this._layer.setLatLngs(newCoords);
        this._fireChange(this._layer.getLatLngs(), "Edit");
      }
      this._tempDragCoord = latlng;
      e.layer = this._layer;
      this._fireDrag(e);
    },
    addDraggingClass() {
      const el = this._getDOMElem();
      if (el) {
        L.DomUtil.addClass(el, "leaflet-pm-draggable");
      }
    },
    removeDraggingClass() {
      const el = this._getDOMElem();
      if (el) {
        L.DomUtil.removeClass(el, "leaflet-pm-draggable");
      }
    },
    _getDOMElem() {
      let el = null;
      if (this._layer._path) {
        el = this._layer._path;
      } else if (this._layer._renderer && this._layer._renderer._container) {
        el = this._layer._renderer._container;
      } else if (this._layer._image) {
        el = this._layer._image;
      } else if (this._layer._icon) {
        el = this._layer._icon;
      }
      return el;
    },
    _overwriteEventIfItComesFromMarker(e) {
      const isMarker = e.target.getLatLng && (!e.target._radius || e.target._radius <= 10);
      if (isMarker) {
        e.containerPoint = this._map.mouseEventToContainerPoint(e.originalEvent);
        e.latlng = this._map.containerPointToLatLng(e.containerPoint);
      }
    },
    _syncLayers(fnc, e) {
      if (this.enabled()) {
        return false;
      }
      if (!e._fromLayerSync && this._layer === e.target && this.options.syncLayersOnDrag) {
        e._fromLayerSync = true;
        let layersToSync = [];
        if (L.Util.isArray(this.options.syncLayersOnDrag)) {
          layersToSync = this.options.syncLayersOnDrag;
          this.options.syncLayersOnDrag.forEach((layer) => {
            if (layer instanceof L.LayerGroup) {
              layersToSync = layersToSync.concat(layer.pm.getLayers(true));
            }
          });
        } else if (this.options.syncLayersOnDrag === true) {
          if (this._parentLayerGroup) {
            for (const key in this._parentLayerGroup) {
              const lg = this._parentLayerGroup[key];
              if (lg.pm) {
                layersToSync = lg.pm.getLayers(true);
              }
            }
          }
        }
        if (L.Util.isArray(layersToSync) && layersToSync.length > 0) {
          layersToSync = layersToSync.filter((layer) => !!layer.pm).filter((layer) => !!layer.pm.options.draggable);
          layersToSync.forEach((layer) => {
            if (layer !== this._layer && layer.pm[fnc]) {
              layer._snapped = false;
              layer.pm[fnc](e);
            }
          });
        }
        return layersToSync.length > 0;
      }
      return false;
    },
    _stopDOMImageDrag(e) {
      e.preventDefault();
      return false;
    }
  };
  var Dragging_default = DragMixin;

  // src/js/Mixins/Rotating.ts
  var import_get3 = __toESM(require_get());

  // src/js/helpers/ModeHelper.ts
  function _convertLatLng(latlng, matrix, map, zoom) {
    return map.unproject(matrix.transform(map.project(latlng, zoom)), zoom);
  }
  function _convertLatLngs(latlng, matrix, map) {
    let zoom = map.getMaxZoom();
    if (zoom === Infinity) {
      zoom = map.getZoom();
    }
    if (L.Util.isArray(latlng)) {
      const latlngs = [];
      latlng.forEach((x) => {
        latlngs.push(_convertLatLngs(x, matrix, map));
      });
      return latlngs;
    }
    if (latlng instanceof L.LatLng) {
      return _convertLatLng(latlng, matrix, map, zoom);
    }
    return null;
  }
  function _toPoint(map, latlng) {
    if (latlng instanceof L.Layer) {
      latlng = latlng.getLatLng();
    }
    let zoom = map.getMaxZoom();
    if (zoom === Infinity) {
      zoom = map.getZoom();
    }
    return map.project(latlng, zoom);
  }
  function _toLatLng(map, point2) {
    let zoom = map.getMaxZoom();
    if (zoom === Infinity) {
      zoom = map.getZoom();
    }
    return map.unproject(point2, zoom);
  }

  // src/js/Mixins/Rotating.ts
  var RotateMixin = {
    _onRotateStart(e) {
      this._preventRenderingMarkers(true);
      this._rotationOriginLatLng = this._getRotationCenter().clone();
      this._rotationOriginPoint = _toPoint(
        this._map,
        this._rotationOriginLatLng
      );
      this._rotationStartPoint = _toPoint(this._map, e.target.getLatLng());
      this._initialRotateLatLng = copyLatLngs(this._layer);
      this._startAngle = this.getAngle();
      const originLatLngs = copyLatLngs(
        this._rotationLayer,
        this._rotationLayer.pm._rotateOrgLatLng
      );
      this._fireRotationStart(this._rotationLayer, originLatLngs);
      this._fireRotationStart(this._map, originLatLngs);
    },
    _onRotate(e) {
      const position = _toPoint(this._map, e.target.getLatLng());
      const previous = this._rotationStartPoint;
      const origin = this._rotationOriginPoint;
      const angleDiffRadiant = Math.atan2(position.y - origin.y, position.x - origin.x) - Math.atan2(previous.y - origin.y, previous.x - origin.x);
      this._layer.setLatLngs(
        this._rotateLayer(
          angleDiffRadiant,
          this._initialRotateLatLng,
          this._rotationOriginLatLng,
          L.PM.Matrix.init(),
          this._map
        )
      );
      const that = this;
      function forEachLatLng(latlng, path = [], _i = -1) {
        if (_i > -1) {
          path.push(_i);
        }
        if (L.Util.isArray(latlng[0])) {
          latlng.forEach(
            (x, i) => forEachLatLng(x, path.slice(), i)
          );
        } else {
          const markers = path.length > 0 ? (0, import_get3.default)(that._markers, path) : that._markers[0];
          latlng.forEach((_latlng, j) => {
            const marker = markers[j];
            marker.setLatLng(_latlng);
          });
        }
      }
      forEachLatLng(this._layer.getLatLngs());
      const oldLatLngs = copyLatLngs(this._rotationLayer);
      this._rotationLayer.setLatLngs(
        this._rotateLayer(
          angleDiffRadiant,
          this._rotationLayer.pm._rotateOrgLatLng,
          this._rotationOriginLatLng,
          L.PM.Matrix.init(),
          this._map
        )
      );
      let angleDiff = angleDiffRadiant * 180 / Math.PI;
      angleDiff = angleDiff < 0 ? angleDiff + 360 : angleDiff;
      const angle = angleDiff + this._startAngle;
      this._setAngle(angle);
      this._rotationLayer.pm._setAngle(angle);
      this._fireRotation(this._rotationLayer, angleDiff, oldLatLngs);
      this._fireRotation(this._map, angleDiff, oldLatLngs);
      this._rotationLayer.pm._fireChange(
        this._rotationLayer.getLatLngs(),
        "Rotation"
      );
    },
    _onRotateEnd() {
      const startAngle = this._startAngle;
      delete this._rotationOriginLatLng;
      delete this._rotationOriginPoint;
      delete this._rotationStartPoint;
      delete this._initialRotateLatLng;
      delete this._startAngle;
      const originLatLngs = copyLatLngs(
        this._rotationLayer,
        this._rotationLayer.pm._rotateOrgLatLng
      );
      this._rotationLayer.pm._rotateOrgLatLng = copyLatLngs(
        this._rotationLayer
      );
      this._fireRotationEnd(this._rotationLayer, startAngle, originLatLngs);
      this._fireRotationEnd(this._map, startAngle, originLatLngs);
      this._rotationLayer.pm._fireEdit(this._rotationLayer, "Rotation");
      this._preventRenderingMarkers(false);
      this._layerRotated = true;
    },
    _rotateLayer(radiant, latlngs, origin, _matrix, map) {
      const originPoint = _toPoint(map, origin);
      this._matrix = _matrix.clone().rotate(radiant, originPoint).flip();
      return _convertLatLngs(latlngs, this._matrix, map);
    },
    _setAngle(angle) {
      angle = angle < 0 ? angle + 360 : angle;
      this._angle = angle % 360;
    },
    _getRotationCenter() {
      if (this._rotationCenter) {
        return this._rotationCenter;
      }
      const polygon = L.polygon(this._layer.getLatLngs(), {
        stroke: false,
        fill: false,
        pmIgnore: true
      }).addTo(this._layer._map);
      const center = polygon.getCenter();
      polygon.removeFrom(this._layer._map);
      return center;
    },
    /*
     *
     * Public functions f.ex. to disable and enable rotation on the layer directly
     *
     */
    enableRotate() {
      if (!this.options.allowRotation) {
        this.disableRotate();
        return;
      }
      if (this.rotateEnabled()) {
        this.disableRotate();
      }
      if (this._layer instanceof L.Rectangle && this._angle === void 0) {
        this.setInitAngle(
          calcAngle(
            this._layer._map,
            this._layer.getLatLngs()[0][0],
            this._layer.getLatLngs()[0][1]
          ) || 0
        );
      }
      const options = {
        fill: false,
        stroke: false,
        pmIgnore: false,
        snapIgnore: true
      };
      this._rotatePoly = L.polygon(
        this._layer.getLatLngs(),
        options
      );
      this._rotatePoly._pmTempLayer = true;
      this._rotatePoly.addTo(this._layer._map);
      this._rotatePoly.pm._setAngle(this.getAngle());
      this._rotatePoly.pm.setRotationCenter(this.getRotationCenter());
      this._rotatePoly.pm.setOptions(this._layer._map.pm.getGlobalOptions());
      this._rotatePoly.pm.setOptions({
        rotate: true,
        snappable: false,
        hideMiddleMarkers: true
      });
      this._rotatePoly.pm._rotationLayer = this._layer;
      this._rotatePoly.pm.enable();
      this._rotateOrgLatLng = copyLatLngs(this._layer);
      this._rotateEnabled = true;
      this._layer.on("remove", this.disableRotate, this);
      this._fireRotationEnable(this._layer);
      this._fireRotationEnable(this._layer._map);
    },
    disableRotate() {
      if (this.rotateEnabled()) {
        if (this._rotatePoly.pm._layerRotated) {
          this._fireUpdate();
        }
        this._rotatePoly.pm._layerRotated = false;
        this._rotatePoly.pm.disable();
        this._rotatePoly.remove();
        this._rotatePoly.pm.setOptions({ rotate: false });
        this._rotatePoly = void 0;
        this._rotateOrgLatLng = void 0;
        this._layer.off("remove", this.disableRotate, this);
        this._rotateEnabled = false;
        this._fireRotationDisable(this._layer);
        this._fireRotationDisable(this._layer._map);
      }
    },
    rotateEnabled() {
      return !!this._rotateEnabled;
    },
    // angle is clockwise (0-360)
    rotateLayer(degrees) {
      const oldAngle = this.getAngle();
      const oldLatLngs = this._layer.getLatLngs();
      const rads = degrees * (Math.PI / 180);
      this._layer.setLatLngs(
        this._rotateLayer(
          rads,
          this._layer.getLatLngs(),
          this._getRotationCenter(),
          L.PM.Matrix.init(),
          this._layer._map
        )
      );
      this._rotateOrgLatLng = L.polygon(this._layer.getLatLngs()).getLatLngs();
      this._setAngle(this.getAngle() + degrees);
      if (this.rotateEnabled() && this._rotatePoly && this._rotatePoly.pm.enabled()) {
        this._rotatePoly.setLatLngs(
          this._rotateLayer(
            rads,
            this._rotatePoly.getLatLngs(),
            this._getRotationCenter(),
            L.PM.Matrix.init(),
            this._rotatePoly._map
          )
        );
        this._rotatePoly.pm._initMarkers();
      }
      let angleDiff = this.getAngle() - oldAngle;
      angleDiff = angleDiff < 0 ? angleDiff + 360 : angleDiff;
      this._startAngle = oldAngle;
      this._fireRotation(this._layer, angleDiff, oldLatLngs, this._layer);
      this._fireRotation(
        this._map || this._layer._map,
        angleDiff,
        oldLatLngs,
        this._layer
      );
      delete this._startAngle;
      this._fireChange(this._layer.getLatLngs(), "Rotation");
    },
    rotateLayerToAngle(degrees) {
      const newAnlge = degrees - this.getAngle();
      this.rotateLayer(newAnlge);
    },
    // angle is clockwise (0-360)
    getAngle() {
      return this._angle || 0;
    },
    // angle is clockwise (0-360)
    setInitAngle(degrees) {
      this._setAngle(degrees);
    },
    getRotationCenter() {
      return this._getRotationCenter();
    },
    setRotationCenter(center) {
      this._rotationCenter = center;
      if (this._rotatePoly) {
        this._rotatePoly.pm.setRotationCenter(center);
      }
    }
  };
  var Rotating_default = RotateMixin;

  // src/js/Edit/L.PM.Edit.ts
  var Edit = L.Class.extend({
    includes: [Dragging_default, Snapping_default, Rotating_default, Events_default],
    options: {
      snappable: true,
      // TODO: next major Release, rename it to allowSnapping
      snapDistance: 20,
      allowSelfIntersection: true,
      allowSelfIntersectionEdit: false,
      preventMarkerRemoval: false,
      removeLayerBelowMinVertexCount: true,
      limitMarkersToCount: -1,
      hideMiddleMarkers: false,
      snapSegment: true,
      syncLayersOnDrag: false,
      draggable: true,
      // TODO: next major Release, rename it to allowDragging
      allowEditing: true,
      // disable all interactions on a layer which are activated with `enable()`. For example a Circle can't be dragged in Edit-Mode
      allowRemoval: true,
      allowCutting: true,
      allowRotation: true,
      addVertexOn: "click",
      removeVertexOn: "contextmenu",
      removeVertexValidation: void 0,
      addVertexValidation: void 0,
      moveVertexValidation: void 0,
      resizeableCircleMarker: false,
      resizeableCircle: true,
      snapMiddle: false,
      snapVertex: true
    },
    setOptions(options) {
      L.Util.setOptions(this, options);
    },
    getOptions() {
      return this.options;
    },
    applyOptions() {
    },
    isPolygon() {
      return this._layer instanceof L.Polygon;
    },
    getShape() {
      return this._shape;
    },
    _setPane(layer, type) {
      if (type === "layerPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.layerPane || "overlayPane";
      } else if (type === "vertexPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.vertexPane || "markerPane";
      } else if (type === "markerPane") {
        layer.options.pane = this._map.pm.globalOptions.panes && this._map.pm.globalOptions.panes.markerPane || "markerPane";
      }
    },
    remove() {
      const map = this._map || this._layer._map;
      map.pm.removeLayer({ target: this._layer });
    },
    _vertexValidation(type, e) {
      const marker = e.target;
      const args = { layer: this._layer, marker, event: e };
      let validationFnc = "";
      if (type === "move") {
        validationFnc = "moveVertexValidation";
      } else if (type === "add") {
        validationFnc = "addVertexValidation";
      } else if (type === "remove") {
        validationFnc = "removeVertexValidation";
      }
      if (this.options[validationFnc] && typeof this.options[validationFnc] === "function" && !this.options[validationFnc](args)) {
        if (type === "move") {
          marker._cancelDragEventChain = marker.getLatLng();
        }
        return false;
      }
      marker._cancelDragEventChain = null;
      return true;
    },
    _vertexValidationDrag(marker) {
      if (marker._cancelDragEventChain) {
        marker._latlng = marker._cancelDragEventChain;
        marker.update();
        return false;
      }
      return true;
    },
    _vertexValidationDragEnd(marker) {
      if (marker._cancelDragEventChain) {
        marker._cancelDragEventChain = null;
        return false;
      }
      return true;
    }
  });
  var L_PM_Edit_default = Edit;

  // src/js/Edit/L.PM.Edit.LayerGroup.ts
  L_PM_Edit_default.LayerGroup = L.Class.extend({
    initialize(layerGroup) {
      this._layerGroup = layerGroup;
      this._layers = this.getLayers();
      this._getMap();
      this._layers.forEach((layer) => this._initLayer(layer));
      const addThrottle = (e) => {
        if (e.layer._pmTempLayer) {
          return;
        }
        this._layers = this.getLayers();
        const _initLayers = this._layers.filter(
          (layer) => !layer.pm._parentLayerGroup || !(this._layerGroup._leaflet_id in layer.pm._parentLayerGroup)
        );
        _initLayers.forEach((layer) => {
          this._initLayer(layer);
        });
        if (_initLayers.length > 0 && this._getMap() && this._getMap().pm.globalEditModeEnabled()) {
          if (this.enabled()) {
            this.enable(this.getOptions());
          }
        }
      };
      this._layerGroup.on(
        "layeradd",
        L.Util.throttle(addThrottle, 100, this),
        this
      );
      this._layerGroup.on(
        "layerremove",
        (e) => {
          this._removeLayerFromGroup(e.target);
        },
        this
      );
      const removeThrottle = (e) => {
        if (e.target._pmTempLayer) {
          return;
        }
        this._layers = this.getLayers();
      };
      this._layerGroup.on(
        "layerremove",
        L.Util.throttle(removeThrottle, 100, this),
        this
      );
    },
    enable(options, _layerIds = []) {
      if (_layerIds.length === 0) {
        this._layers = this.getLayers();
      }
      this._options = options;
      this._layers.forEach((layer) => {
        if (layer instanceof L.LayerGroup) {
          if (_layerIds.indexOf(layer._leaflet_id) === -1) {
            _layerIds.push(layer._leaflet_id);
            layer.pm.enable(options, _layerIds);
          }
        } else {
          layer.pm.enable(options);
        }
      });
    },
    disable(_layerIds = []) {
      if (_layerIds.length === 0) {
        this._layers = this.getLayers();
      }
      this._layers.forEach((layer) => {
        if (layer instanceof L.LayerGroup) {
          if (_layerIds.indexOf(layer._leaflet_id) === -1) {
            _layerIds.push(layer._leaflet_id);
            layer.pm.disable(_layerIds);
          }
        } else {
          layer.pm.disable();
        }
      });
    },
    enabled(_layerIds = []) {
      if (_layerIds.length === 0) {
        this._layers = this.getLayers();
      }
      const enabled = this._layers.find((layer) => {
        if (layer instanceof L.LayerGroup) {
          if (_layerIds.indexOf(layer._leaflet_id) === -1) {
            _layerIds.push(layer._leaflet_id);
            return layer.pm.enabled(_layerIds);
          }
          return false;
        }
        return layer.pm.enabled();
      });
      return !!enabled;
    },
    toggleEdit(options, _layerIds = []) {
      if (_layerIds.length === 0) {
        this._layers = this.getLayers();
      }
      this._options = options;
      this._layers.forEach((layer) => {
        if (layer instanceof L.LayerGroup) {
          if (_layerIds.indexOf(layer._leaflet_id) === -1) {
            _layerIds.push(layer._leaflet_id);
            layer.pm.toggleEdit(options, _layerIds);
          }
        } else {
          layer.pm.toggleEdit(options);
        }
      });
    },
    _initLayer(layer) {
      const id = L.Util.stamp(this._layerGroup);
      if (!layer.pm._parentLayerGroup) {
        layer.pm._parentLayerGroup = {};
      }
      layer.pm._parentLayerGroup[id] = this._layerGroup;
    },
    _removeLayerFromGroup(layer) {
      if (layer.pm && layer.pm._layerGroup) {
        const id = L.Util.stamp(this._layerGroup);
        delete layer.pm._layerGroup[id];
      }
    },
    dragging() {
      this._layers = this.getLayers();
      if (this._layers) {
        const dragging = this._layers.find((layer) => layer.pm.dragging());
        return !!dragging;
      }
      return false;
    },
    getOptions() {
      return this.options;
    },
    _getMap() {
      return this._map || this._layers.find((l) => !!l._map)?._map || null;
    },
    getLayers(deep = false, filterGeoman = true, filterGroupsOut = true, _layerIds = []) {
      let layers = [];
      if (deep) {
        this._layerGroup.getLayers().forEach((layer) => {
          layers.push(layer);
          if (layer instanceof L.LayerGroup) {
            if (_layerIds.indexOf(layer._leaflet_id) === -1) {
              _layerIds.push(layer._leaflet_id);
              layers = layers.concat(
                layer.pm.getLayers(
                  true,
                  true,
                  true,
                  _layerIds
                )
              );
            }
          }
        });
      } else {
        layers = this._layerGroup.getLayers();
      }
      if (filterGroupsOut) {
        layers = layers.filter((layer) => !(layer instanceof L.LayerGroup));
      }
      if (filterGeoman) {
        layers = layers.filter((layer) => !!layer.pm);
        layers = layers.filter((layer) => !layer._pmTempLayer);
        layers = layers.filter(
          (layer) => !L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
          L.PM.optIn && layer.options.pmIgnore === false
          // if optIn is true and pmIgnore is false);
        );
      }
      return layers;
    },
    setOptions(options, _layerIds = []) {
      if (_layerIds.length === 0) {
        this._layers = this.getLayers();
      }
      this.options = options;
      this._layers.forEach((layer) => {
        if (layer.pm) {
          if (layer instanceof L.LayerGroup) {
            if (_layerIds.indexOf(layer._leaflet_id) === -1) {
              _layerIds.push(layer._leaflet_id);
              layer.pm.setOptions(options, _layerIds);
            }
          } else {
            layer.pm.setOptions(options);
          }
        }
      });
    }
  });

  // src/js/Edit/L.PM.Edit.Marker.ts
  L_PM_Edit_default.Marker = L_PM_Edit_default.extend({
    _shape: "Marker",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
      this._layer.on("dragend", this._onDragEnd, this);
    },
    // TODO: remove default option in next major Release
    enable(options = { draggable: true }) {
      L.Util.setOptions(this, options);
      if (!this.options.allowEditing || !this._layer._map) {
        this.disable();
        return;
      }
      this._map = this._layer._map;
      if (this.enabled()) {
        this.disable();
      }
      this.applyOptions();
      this._layer.on("remove", this.disable, this);
      this._enabled = true;
      this._layer.on("pm:dragstart", this._onDragStart, this);
      this._layer.on("pm:dragend", this._onMarkerDragEnd, this);
      this._fireEnable();
    },
    disable() {
      if (!this.enabled()) {
        return;
      }
      this.disableLayerDrag();
      this._layer.off("remove", this.disable, this);
      this._layer.off("contextmenu", this._removeMarker, this);
      if (this._layerEdited) {
        this._fireUpdate();
      }
      this._layerEdited = false;
      this._fireDisable();
      this._enabled = false;
    },
    enabled() {
      return this._enabled;
    },
    toggleEdit(options) {
      if (!this.enabled()) {
        this.enable(options);
      } else {
        this.disable();
      }
    },
    applyOptions() {
      if (this.options.snappable) {
        this._initSnappableMarkers();
      } else {
        this._disableSnapping();
      }
      if (this.options.draggable) {
        this.enableLayerDrag();
      } else {
        this.disableLayerDrag();
      }
      if (!this.options.preventMarkerRemoval) {
        this._layer.on("contextmenu", this._removeMarker, this);
      }
    },
    _removeMarker(e) {
      const marker = e.target;
      marker.remove();
      this._fireRemove(marker);
      this._fireRemove(this._map, marker);
    },
    _onDragStart() {
      this._map.pm.Draw.Marker._layerIsDragging = true;
    },
    _onMarkerDragEnd() {
      this._map.pm.Draw.Marker._layerIsDragging = false;
    },
    _onDragEnd() {
      this._fireEdit();
      this._layerEdited = true;
    },
    // overwrite initSnappableMarkers from Snapping.js Mixin
    _initSnappableMarkers() {
      const marker = this._layer;
      this.options.snapDistance = this.options.snapDistance || 30;
      this.options.snapSegment = this.options.snapSegment === void 0 ? true : this.options.snapSegment;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.on("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.on("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
      marker.on("pm:dragstart", this._unsnap, this);
    },
    _disableSnapping() {
      const marker = this._layer;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
    }
  });

  // src/js/Edit/L.PM.Edit.Line.ts
  var import_get4 = __toESM(require_get());

  // src/js/Mixins/MarkerLimits.ts
  var MarkerLimits = {
    filterMarkerGroup() {
      this.markerCache = [];
      this.createCache();
      this._layer.on("pm:edit", this.createCache, this);
      this.applyLimitFilters({});
      if (!this.throttledApplyLimitFilters) {
        this.throttledApplyLimitFilters = L.Util.throttle(
          this.applyLimitFilters,
          100,
          this
        );
      }
      this._layer.on("pm:disable", this._removeMarkerLimitEvents, this);
      this._layer.on("remove", this._removeMarkerLimitEvents, this);
      if (this.options.limitMarkersToCount > -1) {
        this._layer.on("pm:vertexremoved", this._initMarkers, this);
        this._map.on("mousemove", this.throttledApplyLimitFilters, this);
      }
    },
    _removeMarkerLimitEvents() {
      this._map.off("mousemove", this.throttledApplyLimitFilters, this);
      this._layer.off("pm:edit", this.createCache, this);
      this._layer.off("pm:disable", this._removeMarkerLimitEvents, this);
      this._layer.off("pm:vertexremoved", this._initMarkers, this);
    },
    createCache() {
      const allMarkers = [
        ...this._markerGroup.getLayers(),
        ...this.markerCache
      ];
      this.markerCache = allMarkers.filter((v3, i, s) => s.indexOf(v3) === i);
    },
    _removeFromCache(marker) {
      const markerCacheIndex = this.markerCache.indexOf(marker);
      if (markerCacheIndex > -1) {
        this.markerCache.splice(markerCacheIndex, 1);
      }
    },
    renderLimits(markers) {
      this.markerCache.forEach((l) => {
        if (markers.includes(l)) {
          this._markerGroup.addLayer(l);
        } else {
          this._markerGroup.removeLayer(l);
        }
      });
    },
    applyLimitFilters({ latlng = { lat: 0, lng: 0 } }) {
      if (this._preventRenderMarkers) {
        return;
      }
      const makersNearCursor = this._filterClosestMarkers(latlng);
      const markersToAdd = [...makersNearCursor];
      this.renderLimits(markersToAdd);
    },
    _filterClosestMarkers(latlng) {
      const markers = [...this.markerCache];
      const limit = this.options.limitMarkersToCount;
      if (limit === -1) {
        return markers;
      }
      markers.sort((l, t) => {
        const distanceA = l._latlng.distanceTo(latlng);
        const distanceB = t._latlng.distanceTo(latlng);
        return distanceA - distanceB;
      });
      const closest = markers.filter((l, i) => limit > -1 ? i < limit : true);
      return closest;
    },
    _preventRenderMarkers: false,
    _preventRenderingMarkers(value) {
      this._preventRenderMarkers = !!value;
    }
  };
  var MarkerLimits_default = MarkerLimits;

  // src/js/Edit/L.PM.Edit.Line.ts
  L_PM_Edit_default.Line = L_PM_Edit_default.extend({
    includes: [MarkerLimits_default],
    _shape: "Line",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
    },
    enable(options) {
      L.Util.setOptions(this, options);
      this._map = this._layer._map;
      if (!this._map) {
        return;
      }
      if (!this.options.allowEditing) {
        this.disable();
        return;
      }
      if (this.enabled()) {
        this.disable();
      }
      this._enabled = true;
      this._initMarkers();
      this.applyOptions();
      this._layer.on("remove", this.disable, this);
      if (!this.options.allowSelfIntersection) {
        this._layer.on(
          "pm:vertexremoved",
          this._handleSelfIntersectionOnVertexRemoval,
          this
        );
      }
      if (!this.options.allowSelfIntersection) {
        if (this._layer.options.color !== "#f00000ff") {
          this.cachedColor = this._layer.options.color;
          this.isRed = false;
        } else {
          this.isRed = true;
        }
        this._handleLayerStyle();
      } else {
        this.cachedColor = void 0;
      }
      this._fireEnable();
    },
    disable() {
      if (!this.enabled()) {
        return;
      }
      if (this._dragging) {
        return;
      }
      this._enabled = false;
      this._markerGroup.clearLayers();
      this._markerGroup.removeFrom(this._map);
      this._layer.off("remove", this.disable, this);
      if (!this.options.allowSelfIntersection) {
        this._layer.off(
          "pm:vertexremoved",
          this._handleSelfIntersectionOnVertexRemoval,
          this
        );
      }
      const el = this._layer._path ? this._layer._path : this._layer._renderer._container;
      L.DomUtil.removeClass(el, "leaflet-pm-draggable");
      if (this._layerEdited) {
        this._fireUpdate();
      }
      this._layerEdited = false;
      this._fireDisable();
    },
    enabled() {
      return this._enabled;
    },
    toggleEdit(options) {
      if (!this.enabled()) {
        this.enable(options);
      } else {
        this.disable();
      }
      return this.enabled();
    },
    applyOptions() {
      if (this.options.snappable) {
        this._initSnappableMarkers();
      } else {
        this._disableSnapping();
      }
    },
    _initMarkers() {
      const map = this._map;
      const coords = this._layer.getLatLngs();
      if (this._markerGroup) {
        this._markerGroup.removeFrom(map);
        this._markerGroup.clearLayers();
      }
      this._markerGroup = new L.FeatureGroup();
      this._markerGroup._pmTempLayer = true;
      const handleRing = (coordsArr) => {
        if (Array.isArray(coordsArr[0])) {
          return coordsArr.map(handleRing, this);
        }
        const ringArr = coordsArr.map(this._createMarker, this);
        if (this.options.hideMiddleMarkers !== true) {
          coordsArr.map((v3, k) => {
            const nextIndex = this.isPolygon() ? (k + 1) % coordsArr.length : k + 1;
            return this._createMiddleMarker(ringArr[k], ringArr[nextIndex]);
          });
        }
        return ringArr;
      };
      this._markers = handleRing(coords);
      this.filterMarkerGroup();
      map.addLayer(this._markerGroup);
    },
    // creates initial markers for coordinates
    _createMarker(latlng) {
      const marker = new L.Marker(latlng, {
        draggable: true,
        icon: L.divIcon({ className: "marker-icon" })
      });
      this._setPane(marker, "vertexPane");
      marker._pmTempLayer = true;
      if (this.options.rotate) {
        marker.on("dragstart", this._onRotateStart, this);
        marker.on("drag", this._onRotate, this);
        marker.on("dragend", this._onRotateEnd, this);
      } else {
        marker.on("click", this._onVertexClick, this);
        marker.on("dragstart", this._onMarkerDragStart, this);
        marker.on("move", this._onMarkerDrag, this);
        marker.on("dragend", this._onMarkerDragEnd, this);
        if (!this.options.preventMarkerRemoval) {
          marker.on(this.options.removeVertexOn, this._removeMarker, this);
        }
      }
      this._markerGroup.addLayer(marker);
      return marker;
    },
    // creates the middle markes between coordinates
    _createMiddleMarker(leftM, rightM) {
      if (!leftM || !rightM) {
        return false;
      }
      const latlng = L.PM.Utils.calcMiddleLatLng(
        this._map,
        leftM.getLatLng(),
        rightM.getLatLng()
      );
      const middleMarker = this._createMarker(latlng);
      const middleIcon = L.divIcon({
        className: "marker-icon marker-icon-middle"
      });
      middleMarker.setIcon(middleIcon);
      middleMarker.leftM = leftM;
      middleMarker.rightM = rightM;
      leftM._middleMarkerNext = middleMarker;
      rightM._middleMarkerPrev = middleMarker;
      middleMarker.on(this.options.addVertexOn, this._onMiddleMarkerClick, this);
      middleMarker.on("movestart", this._onMiddleMarkerMoveStart, this);
      return middleMarker;
    },
    _onMiddleMarkerClick(e) {
      const middleMarker = e.target;
      if (!this._vertexValidation("add", e)) {
        return;
      }
      const icon = L.divIcon({ className: "marker-icon" });
      middleMarker.setIcon(icon);
      this._addMarker(middleMarker, middleMarker.leftM, middleMarker.rightM);
    },
    _onMiddleMarkerMoveStart(e) {
      const middleMarker = e.target;
      middleMarker.on("moveend", this._onMiddleMarkerMoveEnd, this);
      if (!this._vertexValidation("add", e)) {
        middleMarker.on("move", this._onMiddleMarkerMovePrevent, this);
        return;
      }
      middleMarker._dragging = true;
      this._addMarker(middleMarker, middleMarker.leftM, middleMarker.rightM);
    },
    _onMiddleMarkerMovePrevent(e) {
      const middleMarker = e.target;
      this._vertexValidationDrag(middleMarker);
    },
    _onMiddleMarkerMoveEnd(e) {
      const middleMarker = e.target;
      middleMarker.off("move", this._onMiddleMarkerMovePrevent, this);
      middleMarker.off("moveend", this._onMiddleMarkerMoveEnd, this);
      if (!this._vertexValidationDragEnd(middleMarker)) {
        return;
      }
      const icon = L.divIcon({ className: "marker-icon" });
      middleMarker.setIcon(icon);
      setTimeout(() => {
        delete middleMarker._dragging;
      }, 100);
    },
    // adds a new marker from a middlemarker
    _addMarker(newM, leftM, rightM) {
      newM.off("movestart", this._onMiddleMarkerMoveStart, this);
      newM.off(this.options.addVertexOn, this._onMiddleMarkerClick, this);
      const latlng = newM.getLatLng();
      const coords = this._layer._latlngs;
      delete newM.leftM;
      delete newM.rightM;
      const { indexPath, index, parentPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        leftM
      );
      const coordsRing = indexPath.length > 1 ? (0, import_get4.default)(coords, parentPath) : coords;
      const markerArr = indexPath.length > 1 ? (0, import_get4.default)(this._markers, parentPath) : this._markers;
      coordsRing.splice(index + 1, 0, latlng);
      markerArr.splice(index + 1, 0, newM);
      this._layer.setLatLngs(coords);
      if (this.options.hideMiddleMarkers !== true) {
        this._createMiddleMarker(leftM, newM);
        this._createMiddleMarker(newM, rightM);
      }
      this._fireEdit();
      this._layerEdited = true;
      this._fireChange(this._layer.getLatLngs(), "Edit");
      this._fireVertexAdded(
        newM,
        L.PM.Utils.findDeepMarkerIndex(this._markers, newM).indexPath,
        latlng
      );
      if (this.options.snappable) {
        this._initSnappableMarkers();
      }
    },
    hasSelfIntersection() {
      const selfIntersection = index_default(this._layer.toGeoJSON(15));
      return selfIntersection.features.length > 0;
    },
    _handleSelfIntersectionOnVertexRemoval() {
      const selfIntersection = this._handleLayerStyle(true);
      if (selfIntersection) {
        this._layer.setLatLngs(this._coordsBeforeEdit);
        this._coordsBeforeEdit = null;
        this._initMarkers();
      }
    },
    _handleLayerStyle(flash) {
      const layer = this._layer;
      let selfIntersection;
      let intersection3;
      if (this.options.allowSelfIntersection) {
        selfIntersection = false;
      } else {
        intersection3 = index_default(this._layer.toGeoJSON(15));
        selfIntersection = intersection3.features.length > 0;
      }
      if (selfIntersection) {
        if (!this.options.allowSelfIntersection && this.options.allowSelfIntersectionEdit) {
          this._updateDisabledMarkerStyle(this._markers, true);
        }
        if (this.isRed) {
          return selfIntersection;
        }
        if (flash) {
          this._flashLayer();
        } else {
          layer.setStyle({ color: "#f00000ff" });
          this.isRed = true;
        }
        this._fireIntersect(intersection3);
      } else {
        layer.setStyle({ color: this.cachedColor });
        this.isRed = false;
        if (!this.options.allowSelfIntersection && this.options.allowSelfIntersectionEdit) {
          this._updateDisabledMarkerStyle(this._markers, false);
        }
      }
      return selfIntersection;
    },
    _flashLayer() {
      if (!this.cachedColor) {
        this.cachedColor = this._layer.options.color;
      }
      this._layer.setStyle({ color: "#f00000ff" });
      this.isRed = true;
      window.setTimeout(() => {
        this._layer.setStyle({ color: this.cachedColor });
        this.isRed = false;
      }, 200);
    },
    _updateDisabledMarkerStyle(markers, disabled) {
      markers.forEach((marker) => {
        if (Array.isArray(marker)) {
          this._updateDisabledMarkerStyle(marker, disabled);
        } else if (marker._icon) {
          if (disabled && !this._checkMarkerAllowedToDrag(marker)) {
            L.DomUtil.addClass(marker._icon, "vertexmarker-disabled");
          } else {
            L.DomUtil.removeClass(marker._icon, "vertexmarker-disabled");
          }
        }
      });
    },
    _removeMarker(e) {
      const marker = e.target;
      if (!this._vertexValidation("remove", e)) {
        return;
      }
      if (!this.options.allowSelfIntersection) {
        this._coordsBeforeEdit = copyLatLngs(
          this._layer,
          this._layer.getLatLngs()
        );
      }
      let coords = this._layer.getLatLngs();
      const { indexPath, index, parentPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      if (!indexPath) {
        return;
      }
      const coordsRing = indexPath.length > 1 ? (0, import_get4.default)(coords, parentPath) : coords;
      let markerArr = indexPath.length > 1 ? (0, import_get4.default)(this._markers, parentPath) : this._markers;
      const isHole = parentPath[parentPath.length - 1] > 0 && this._layer instanceof L.Polygon;
      if (!this.options.removeLayerBelowMinVertexCount && !isHole) {
        if (coordsRing.length <= 2 || this.isPolygon() && coordsRing.length <= 3) {
          this._flashLayer();
          return;
        }
      }
      coordsRing.splice(index, 1);
      this._layer.setLatLngs(coords);
      if (this.isPolygon() && coordsRing.length <= 2) {
        coordsRing.splice(0, coordsRing.length);
      }
      let layerRemoved = false;
      if (coordsRing.length <= 1) {
        coordsRing.splice(0, coordsRing.length);
        if (parentPath.length > 1 && indexPath.length > 1) {
          coords = removeEmptyCoordRings(coords);
        }
        this._layer.setLatLngs(coords);
        this._initMarkers();
        layerRemoved = true;
      }
      if (!hasValues(coords)) {
        this._layer.remove();
      }
      coords = removeEmptyCoordRings(coords);
      this._layer.setLatLngs(coords);
      this._markers = removeEmptyCoordRings(this._markers);
      if (!layerRemoved) {
        markerArr = indexPath.length > 1 ? (0, import_get4.default)(this._markers, parentPath) : this._markers;
        if (marker._middleMarkerPrev) {
          this._markerGroup.removeLayer(marker._middleMarkerPrev);
          this._removeFromCache(marker._middleMarkerPrev);
        }
        if (marker._middleMarkerNext) {
          this._markerGroup.removeLayer(marker._middleMarkerNext);
          this._removeFromCache(marker._middleMarkerNext);
        }
        this._markerGroup.removeLayer(marker);
        this._removeFromCache(marker);
        if (markerArr) {
          let rightMarkerIndex;
          let leftMarkerIndex;
          if (this.isPolygon()) {
            rightMarkerIndex = (index + 1) % markerArr.length;
            leftMarkerIndex = (index + (markerArr.length - 1)) % markerArr.length;
          } else {
            leftMarkerIndex = index - 1 < 0 ? void 0 : index - 1;
            rightMarkerIndex = index + 1 >= markerArr.length ? void 0 : index + 1;
          }
          if (rightMarkerIndex !== leftMarkerIndex) {
            const leftM = markerArr[leftMarkerIndex];
            const rightM = markerArr[rightMarkerIndex];
            if (this.options.hideMiddleMarkers !== true) {
              this._createMiddleMarker(leftM, rightM);
            }
          }
          markerArr.splice(index, 1);
        }
      }
      this._fireEdit();
      this._layerEdited = true;
      this._fireVertexRemoved(marker, indexPath);
      this._fireChange(this._layer.getLatLngs(), "Edit");
    },
    updatePolygonCoordsFromMarkerDrag(marker) {
      const coords = this._layer.getLatLngs();
      const latlng = marker.getLatLng();
      const { indexPath, index, parentPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      const parent = indexPath.length > 1 ? (0, import_get4.default)(coords, parentPath) : coords;
      latlng.alt = parent[index].alt;
      parent.splice(index, 1, latlng);
      this._layer.setLatLngs(coords);
    },
    _getNeighborMarkers(marker) {
      const { indexPath, index, parentPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      const markerArr = indexPath.length > 1 ? (0, import_get4.default)(this._markers, parentPath) : this._markers;
      const nextMarkerIndex = (index + 1) % markerArr.length;
      const prevMarkerIndex = (index + (markerArr.length - 1)) % markerArr.length;
      const prevMarker = markerArr[prevMarkerIndex];
      const nextMarker = markerArr[nextMarkerIndex];
      return { prevMarker, nextMarker };
    },
    _checkMarkerAllowedToDrag(marker) {
      const { prevMarker, nextMarker } = this._getNeighborMarkers(marker);
      const prevLine = L.polyline([prevMarker.getLatLng(), marker.getLatLng()]);
      const nextLine = L.polyline([marker.getLatLng(), nextMarker.getLatLng()]);
      const prevLineIntersection = index_default2(
        this._layer.toGeoJSON(15),
        prevLine.toGeoJSON(15)
      );
      const prevLineIntersectionLen = prevLineIntersection.features.filter(
        (f) => {
          const coords = f.geometry.coordinates;
          const latlng = L.latLng(coords[1], coords[0]);
          return !latlng.equals(prevMarker.getLatLng()) && !latlng.equals(marker.getLatLng());
        }
      ).length;
      const nextLineIntersection = index_default2(
        this._layer.toGeoJSON(15),
        nextLine.toGeoJSON(15)
      );
      const nextLineIntersectionLen = nextLineIntersection.features.filter(
        (f) => {
          const coords = f.geometry.coordinates;
          const latlng = L.latLng(coords[1], coords[0]);
          return !latlng.equals(nextMarker.getLatLng()) && !latlng.equals(marker.getLatLng());
        }
      ).length;
      if (prevLineIntersectionLen < 1 && nextLineIntersectionLen < 1) {
        return false;
      }
      return true;
    },
    _onMarkerDragStart(e) {
      const marker = e.target;
      this._preventRenderingMarkers(true);
      if (!this.cachedColor) {
        this.cachedColor = this._layer.options.color;
      }
      if (!this._vertexValidation("move", e)) {
        return;
      }
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      this._fireMarkerDragStart(e, indexPath);
      if (!this.options.allowSelfIntersection) {
        this._coordsBeforeEdit = copyLatLngs(
          this._layer,
          this._layer.getLatLngs()
        );
      }
      if (!this.options.allowSelfIntersection && this.options.allowSelfIntersectionEdit && this.hasSelfIntersection()) {
        this._markerAllowedToDrag = this._checkMarkerAllowedToDrag(marker);
      } else {
        this._markerAllowedToDrag = null;
      }
    },
    _onMarkerDrag(e) {
      const marker = e.target;
      if (!this._vertexValidationDrag(marker)) {
        return;
      }
      const { indexPath, index, parentPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      if (!indexPath) {
        return;
      }
      if (!this.options.allowSelfIntersection && this.options.allowSelfIntersectionEdit && this.hasSelfIntersection() && this._markerAllowedToDrag === false) {
        this._layer.setLatLngs(this._coordsBeforeEdit);
        this._initMarkers();
        this._handleLayerStyle();
        return;
      }
      this.updatePolygonCoordsFromMarkerDrag(marker);
      const markerArr = indexPath.length > 1 ? (0, import_get4.default)(this._markers, parentPath) : this._markers;
      const nextMarkerIndex = (index + 1) % markerArr.length;
      const prevMarkerIndex = (index + (markerArr.length - 1)) % markerArr.length;
      const markerLatLng = marker.getLatLng();
      const prevMarkerLatLng = markerArr[prevMarkerIndex].getLatLng();
      const nextMarkerLatLng = markerArr[nextMarkerIndex].getLatLng();
      if (marker._middleMarkerNext) {
        const middleMarkerNextLatLng = L.PM.Utils.calcMiddleLatLng(
          this._map,
          markerLatLng,
          nextMarkerLatLng
        );
        marker._middleMarkerNext.setLatLng(middleMarkerNextLatLng);
      }
      if (marker._middleMarkerPrev) {
        const middleMarkerPrevLatLng = L.PM.Utils.calcMiddleLatLng(
          this._map,
          markerLatLng,
          prevMarkerLatLng
        );
        marker._middleMarkerPrev.setLatLng(middleMarkerPrevLatLng);
      }
      if (!this.options.allowSelfIntersection) {
        this._handleLayerStyle();
      }
      this._fireMarkerDrag(e, indexPath);
      this._fireChange(this._layer.getLatLngs(), "Edit");
    },
    _onMarkerDragEnd(e) {
      const marker = e.target;
      this._preventRenderingMarkers(false);
      if (!this._vertexValidationDragEnd(marker)) {
        return;
      }
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        marker
      );
      let intersection3 = !this.options.allowSelfIntersection && this.hasSelfIntersection();
      if (intersection3 && this.options.allowSelfIntersectionEdit && this._markerAllowedToDrag) {
        intersection3 = false;
      }
      const intersectionReset = !this.options.allowSelfIntersection && intersection3;
      this._fireMarkerDragEnd(e, indexPath, intersectionReset);
      if (intersectionReset) {
        this._layer.setLatLngs(this._coordsBeforeEdit);
        this._coordsBeforeEdit = null;
        this._initMarkers();
        if (this.options.snappable) {
          this._initSnappableMarkers();
        }
        this._handleLayerStyle();
        this._fireLayerReset(e, indexPath);
        return;
      }
      if (!this.options.allowSelfIntersection && this.options.allowSelfIntersectionEdit) {
        this._handleLayerStyle();
      }
      this._fireEdit();
      this._layerEdited = true;
      this._fireChange(this._layer.getLatLngs(), "Edit");
    },
    _onVertexClick(e) {
      const vertex = e.target;
      if (vertex._dragging) {
        return;
      }
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        vertex
      );
      this._fireVertexClick(e, indexPath);
    }
  });

  // src/js/Edit/L.PM.Edit.Polygon.ts
  L_PM_Edit_default.Polygon = L_PM_Edit_default.Line.extend({
    _shape: "Polygon",
    _checkMarkerAllowedToDrag(marker) {
      const { prevMarker, nextMarker } = this._getNeighborMarkers(marker);
      const prevLine = L.polyline([prevMarker.getLatLng(), marker.getLatLng()]);
      const nextLine = L.polyline([marker.getLatLng(), nextMarker.getLatLng()]);
      const prevLineIntersection = index_default2(
        this._layer.toGeoJSON(15),
        prevLine.toGeoJSON(15)
      );
      const prevLineIntersectionLen = prevLineIntersection.features.filter(
        (f) => {
          const coords = f.geometry.coordinates;
          const latlng = L.latLng(coords[1], coords[0]);
          return !latlng.equals(prevMarker.getLatLng()) && !latlng.equals(marker.getLatLng());
        }
      ).length;
      const nextLineIntersection = index_default2(
        this._layer.toGeoJSON(15),
        nextLine.toGeoJSON(15)
      );
      const nextLineIntersectionLen = nextLineIntersection.features.filter(
        (f) => {
          const coords = f.geometry.coordinates;
          const latlng = L.latLng(coords[1], coords[0]);
          return !latlng.equals(nextMarker.getLatLng()) && !latlng.equals(marker.getLatLng());
        }
      ).length;
      if (prevLineIntersectionLen < 1 && nextLineIntersectionLen < 1) {
        return false;
      }
      return true;
    }
  });

  // src/js/Edit/L.PM.Edit.Rectangle.ts
  L_PM_Edit_default.Rectangle = L_PM_Edit_default.Polygon.extend({
    _shape: "Rectangle",
    // initializes Rectangle Markers
    _initMarkers() {
      const map = this._map;
      const corners = this._findCorners();
      if (this._markerGroup) {
        this._markerGroup.clearLayers();
      }
      this._markerGroup = new L.FeatureGroup();
      this._markerGroup._pmTempLayer = true;
      map.addLayer(this._markerGroup);
      this._markers = [];
      this._markers[0] = corners.map(this._createMarker, this);
      [this._cornerMarkers] = this._markers;
      this._layer.getLatLngs()[0].forEach(
        (latlng, index) => {
          const marker = this._cornerMarkers.find((m) => m._index === index);
          if (marker) {
            marker.setLatLng(latlng);
          }
        }
      );
    },
    applyOptions() {
      if (this.options.snappable) {
        this._initSnappableMarkers();
      } else {
        this._disableSnapping();
      }
      this._addMarkerEvents();
    },
    // creates initial markers for coordinates
    _createMarker(latlng, index) {
      const marker = new L.Marker(latlng, {
        draggable: true,
        icon: L.divIcon({ className: "marker-icon" })
      });
      this._setPane(marker, "vertexPane");
      marker._origLatLng = latlng;
      marker._index = index;
      marker._pmTempLayer = true;
      marker.on("click", this._onVertexClick, this);
      this._markerGroup.addLayer(marker);
      return marker;
    },
    // Add marker events after adding the snapping events to the markers, beacause of the execution order
    _addMarkerEvents() {
      this._markers[0].forEach((marker) => {
        marker.on("dragstart", this._onMarkerDragStart, this);
        marker.on("drag", this._onMarkerDrag, this);
        marker.on("dragend", this._onMarkerDragEnd, this);
        if (!this.options.preventMarkerRemoval) {
          marker.on("contextmenu", this._removeMarker, this);
        }
      });
    },
    // Empty callback for 'contextmenu' binding set in L.PM.Edit.Line.js's _createMarker method (AKA, right-click on marker event)
    // (A Rectangle is designed to always remain a "true" rectangle -- if you want it editable, use Polygon Tool instead!!!)
    _removeMarker() {
      return null;
    },
    _onMarkerDragStart(e) {
      if (!this._vertexValidation("move", e)) {
        return;
      }
      const draggedMarker = e.target;
      const corners = this._cornerMarkers;
      draggedMarker._oppositeCornerLatLng = corners.find((m) => m._index === (draggedMarker._index + 2) % 4).getLatLng();
      draggedMarker._snapped = false;
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        draggedMarker
      );
      this._fireMarkerDragStart(e, indexPath);
    },
    _onMarkerDrag(e) {
      const draggedMarker = e.target;
      if (!this._vertexValidationDrag(draggedMarker)) {
        return;
      }
      if (draggedMarker._index === void 0) {
        return;
      }
      this._adjustRectangleForMarkerMove(draggedMarker);
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        draggedMarker
      );
      this._fireMarkerDrag(e, indexPath);
      this._fireChange(this._layer.getLatLngs(), "Edit");
    },
    _onMarkerDragEnd(e) {
      const draggedMarker = e.target;
      if (!this._vertexValidationDragEnd(draggedMarker)) {
        return;
      }
      this._cornerMarkers.forEach((m) => {
        delete m._oppositeCornerLatLng;
      });
      const { indexPath } = L.PM.Utils.findDeepMarkerIndex(
        this._markers,
        draggedMarker
      );
      this._fireMarkerDragEnd(e, indexPath);
      this._fireEdit();
      this._layerEdited = true;
      this._fireChange(this._layer.getLatLngs(), "Edit");
    },
    // adjusts the rectangle's size and bounds whenever a marker is moved
    // params: movedMarker -- the Marker object
    _adjustRectangleForMarkerMove(movedMarker) {
      L.extend(movedMarker._origLatLng, movedMarker._latlng);
      const corners = L.PM.Utils._getRotatedRectangle(
        movedMarker.getLatLng(),
        movedMarker._oppositeCornerLatLng,
        this.getAngle(),
        this._map
      );
      this._layer.setLatLngs(corners);
      this._adjustAllMarkers(movedMarker);
      this._layer.redraw();
    },
    // adjusts the position of all Markers
    // params: markerLatLngs -- an array of exactly LatLng objects
    _adjustAllMarkers(movedMarker) {
      const markerLatLngs = this._layer.getLatLngs()[0];
      if (markerLatLngs && markerLatLngs.length !== 4 && markerLatLngs.length > 0) {
        markerLatLngs.forEach((latlng, index) => {
          this._cornerMarkers[index].setLatLng(latlng);
        });
        const restMarkers = this._cornerMarkers.slice(markerLatLngs.length);
        restMarkers.forEach((marker) => {
          marker.setLatLng(markerLatLngs[0]);
        });
      } else if (!markerLatLngs || !markerLatLngs.length) {
        console.error("The layer has no LatLngs");
      } else {
        const correctIndex = markerLatLngs.findIndex(
          (latlng) => movedMarker.getLatLng().equals(latlng)
        );
        if (correctIndex > -1) {
          this._cornerMarkers[(movedMarker._index + 1) % 4].setLatLng(
            markerLatLngs[(correctIndex + 1) % 4]
          );
          this._cornerMarkers[(movedMarker._index + 2) % 4].setLatLng(
            markerLatLngs[(correctIndex + 2) % 4]
          );
          this._cornerMarkers[(movedMarker._index + 3) % 4].setLatLng(
            markerLatLngs[(correctIndex + 3) % 4]
          );
        } else {
          this._cornerMarkers.forEach((marker) => {
            marker.setLatLng(markerLatLngs[marker._index]);
          });
        }
      }
    },
    // finds the 4 corners of the current bounding box
    // returns array of 4 LatLng objects in this order: Northwest corner, Northeast corner, Southeast corner, Southwest corner
    _findCorners() {
      if (this._angle === void 0) {
        this.setInitAngle(
          calcAngle(
            this._map,
            this._layer.getLatLngs()[0][0],
            this._layer.getLatLngs()[0][1]
          ) || 0
        );
      }
      const latlngs = this._layer.getLatLngs()[0];
      return L.PM.Utils._getRotatedRectangle(
        latlngs[0],
        latlngs[2],
        this.getAngle(),
        this._map || this
      );
    }
  });

  // src/js/Edit/L.PM.Edit.CircleMarker.ts
  L_PM_Edit_default.CircleMarker = L_PM_Edit_default.extend({
    _shape: "CircleMarker",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
      this._minRadiusOption = "minRadiusCircleMarker";
      this._maxRadiusOption = "maxRadiusCircleMarker";
      this._editableOption = "resizeableCircleMarker";
      this._updateHiddenPolyCircle();
    },
    // TODO: remove default option in next major Release
    enable(options = {
      draggable: true,
      snappable: true
    }) {
      L.Util.setOptions(this, options);
      if (this.options.editable) {
        this.options.resizeableCircleMarker = this.options.editable;
        delete this.options.editable;
      }
      if (!this.options.allowEditing || !this._layer._map) {
        this.disable();
        return;
      }
      this._map = this._layer._map;
      if (this.enabled()) {
        this.disable();
      }
      this.applyOptions();
      this._layer.on("remove", this.disable, this);
      this._enabled = true;
      this._extendingEnable();
      this._updateHiddenPolyCircle();
      this._fireEnable();
    },
    _extendingEnable() {
      this._layer.on("pm:dragstart", this._onDragStart, this);
      this._layer.on("pm:drag", this._onMarkerDrag, this);
      this._layer.on("pm:dragend", this._onMarkerDragEnd, this);
    },
    disable() {
      if (this.dragging()) {
        return;
      }
      if (!this._map) {
        this._map = this._layer._map;
      }
      if (!this._map) {
        return;
      }
      if (!this.enabled()) {
        return;
      }
      if (this.layerDragEnabled()) {
        this.disableLayerDrag();
      }
      if (this._helperLayers) {
        this._helperLayers.clearLayers();
        this._helperLayers.removeFrom(this._map);
      }
      if (this.options[this._editableOption]) {
        this._map.off("move", this._syncMarkers, this);
        this._outerMarker.off("drag", this._handleOuterMarkerSnapping, this);
      } else {
        this._map.off("move", this._updateHiddenPolyCircle, this);
      }
      this._extendingDisable();
      this._layer.off("remove", this.disable, this);
      if (this._layerEdited) {
        this._fireUpdate();
      }
      this._layerEdited = false;
      this._fireDisable();
      this._enabled = false;
    },
    _extendingDisable() {
      this._layer.off("contextmenu", this._removeMarker, this);
    },
    enabled() {
      return this._enabled;
    },
    toggleEdit(options) {
      if (!this.enabled()) {
        this.enable(options);
      } else {
        this.disable();
      }
    },
    applyOptions() {
      if (this.options[this._editableOption]) {
        this._initMarkers();
        this._map.on("move", this._syncMarkers, this);
        if (this.options.snappable) {
          this._initSnappableMarkers();
          this._outerMarker.on("drag", this._handleOuterMarkerSnapping, this);
          this._outerMarker.on("move", this._syncHintLine, this);
          this._outerMarker.on("move", this._syncCircleRadius, this);
        } else {
          this._disableSnapping();
        }
      } else {
        if (this.options.draggable) {
          this.enableLayerDrag();
        }
        this._map.on("move", this._updateHiddenPolyCircle, this);
        if (this.options.snappable) {
          this._initSnappableMarkersDrag();
        } else {
          this._disableSnappingDrag();
        }
      }
      this._extendingApplyOptions();
    },
    _extendingApplyOptions() {
      if (!this.options.preventMarkerRemoval) {
        this._layer.on("contextmenu", this._removeMarker, this);
      }
    },
    _initMarkers() {
      const map = this._map;
      if (this._helperLayers) {
        this._helperLayers.removeFrom(map);
        this._helperLayers.clearLayers();
      }
      this._helperLayers = new L.FeatureGroup();
      this._helperLayers._pmTempLayer = true;
      this._helperLayers.addTo(map);
      const center = this._layer.getLatLng();
      const radius = this._layer._radius;
      const outer = this._getLatLngOnCircle(center, radius);
      this._centerMarker = this._createCenterMarker(center);
      this._outerMarker = this._createOuterMarker(outer);
      this._markers = [this._centerMarker, this._outerMarker];
      this._createHintLine(this._centerMarker, this._outerMarker);
    },
    _getLatLngOnCircle(center, radius) {
      const pointA = this._map.project(center);
      const pointB = L.point(pointA.x + radius, pointA.y);
      return this._map.unproject(pointB);
    },
    _createHintLine(markerA, markerB) {
      const A = markerA.getLatLng();
      const B3 = markerB.getLatLng();
      this._hintline = L.polyline([A, B3], this.options.hintlineStyle);
      this._setPane(this._hintline, "layerPane");
      this._hintline._pmTempLayer = true;
      this._helperLayers.addLayer(this._hintline);
    },
    _createCenterMarker(latlng) {
      const marker = this._createMarker(latlng);
      if (this.options.draggable) {
        L.DomUtil.addClass(marker._icon, "leaflet-pm-draggable");
        marker.on("move", this._moveCircle, this);
      } else {
        marker.dragging.disable();
      }
      return marker;
    },
    _createOuterMarker(latlng) {
      const marker = this._createMarker(latlng);
      marker.on("drag", this._resizeCircle, this);
      return marker;
    },
    _createMarker(latlng) {
      const marker = new L.Marker(latlng, {
        draggable: true,
        icon: L.divIcon({ className: "marker-icon" })
      });
      this._setPane(marker, "vertexPane");
      marker._origLatLng = latlng;
      marker._pmTempLayer = true;
      marker.on("dragstart", this._onMarkerDragStart, this);
      marker.on("drag", this._onMarkerDrag, this);
      marker.on("dragend", this._onMarkerDragEnd, this);
      marker.on("click", this._onVertexClick, this);
      this._helperLayers.addLayer(marker);
      return marker;
    },
    _moveCircle(e) {
      const draggedMarker = e.target;
      if (draggedMarker._cancelDragEventChain) {
        return;
      }
      const center = this._centerMarker.getLatLng();
      this._layer.setLatLng(center);
      const radius = this._layer._radius;
      const outer = this._getLatLngOnCircle(center, radius);
      this._outerMarker._latlng = outer;
      this._outerMarker.update();
      this._syncHintLine();
      this._updateHiddenPolyCircle();
      this._fireCenterPlaced("Edit");
      this._fireChange(this._layer.getLatLng(), "Edit");
    },
    _syncMarkers() {
      const center = this._layer.getLatLng();
      const radius = this._layer._radius;
      const outer = this._getLatLngOnCircle(center, radius);
      this._outerMarker.setLatLng(outer);
      this._centerMarker.setLatLng(center);
      this._syncHintLine();
      this._updateHiddenPolyCircle();
    },
    _resizeCircle() {
      this._outerMarker.setLatLng(this._getNewDestinationOfOuterMarker());
      this._syncHintLine();
      this._syncCircleRadius();
    },
    _syncCircleRadius() {
      const A = this._centerMarker.getLatLng();
      const B3 = this._outerMarker.getLatLng();
      const distance2 = this._distanceCalculation(A, B3);
      if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
        this._layer.setRadius(this.options[this._minRadiusOption]);
      } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
        this._layer.setRadius(this.options[this._maxRadiusOption]);
      } else {
        this._layer.setRadius(distance2);
      }
      this._updateHiddenPolyCircle();
      this._fireChange(this._layer.getLatLng(), "Edit");
    },
    _syncHintLine() {
      const A = this._centerMarker.getLatLng();
      const B3 = this._outerMarker.getLatLng();
      this._hintline.setLatLngs([A, B3]);
    },
    _removeMarker() {
      if (this.options[this._editableOption]) {
        this.disable();
      }
      this._layer.remove();
      this._fireRemove(this._layer);
      this._fireRemove(this._map, this._layer);
    },
    _onDragStart() {
      this._map.pm.Draw.CircleMarker._layerIsDragging = true;
    },
    _onMarkerDragStart(e) {
      if (!this._vertexValidation("move", e)) {
        return;
      }
      this._fireMarkerDragStart(e);
    },
    _onMarkerDrag(e) {
      const draggedMarker = e.target;
      if (draggedMarker instanceof L.Marker && !this._vertexValidationDrag(draggedMarker)) {
        return;
      }
      this._fireMarkerDrag(e);
    },
    _onMarkerDragEnd(e) {
      this._extedingMarkerDragEnd();
      const draggedMarker = e.target;
      if (!this._vertexValidationDragEnd(draggedMarker)) {
        return;
      }
      if (this.options[this._editableOption]) {
        this._fireEdit();
        this._layerEdited = true;
      }
      this._fireMarkerDragEnd(e);
    },
    _extedingMarkerDragEnd() {
      this._map.pm.Draw.CircleMarker._layerIsDragging = false;
    },
    // _initSnappableMarkers when option editable is not true
    _initSnappableMarkersDrag() {
      const marker = this._layer;
      this.options.snapDistance = this.options.snapDistance || 30;
      this.options.snapSegment = this.options.snapSegment === void 0 ? true : this.options.snapSegment;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.on("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.on("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
      marker.on("pm:dragstart", this._unsnap, this);
    },
    // _disableSnapping when option editable is not true
    _disableSnappingDrag() {
      const marker = this._layer;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
    },
    _updateHiddenPolyCircle() {
      const map = this._layer._map || this._map;
      if (map) {
        const radius = L.PM.Utils.pxRadiusToMeterRadius(
          this._layer.getRadius(),
          map,
          this._layer.getLatLng()
        );
        const _layer = L.circle(this._layer.getLatLng(), this._layer.options);
        _layer.setRadius(radius);
        const crsSimple = map && map.pm._isCRSSimple();
        if (this._hiddenPolyCircle) {
          this._hiddenPolyCircle.setLatLngs(
            L.PM.Utils.circleToPolygon(_layer, 200, !crsSimple).getLatLngs()
          );
        } else {
          this._hiddenPolyCircle = L.PM.Utils.circleToPolygon(
            _layer,
            200,
            !crsSimple
          );
        }
        if (!this._hiddenPolyCircle._parentCopy) {
          this._hiddenPolyCircle._parentCopy = this._layer;
        }
      }
    },
    _getNewDestinationOfOuterMarker() {
      const latlng = this._centerMarker.getLatLng();
      let secondLatLng = this._outerMarker.getLatLng();
      const distance2 = this._distanceCalculation(latlng, secondLatLng);
      if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
        secondLatLng = destinationOnLine(
          this._map,
          latlng,
          secondLatLng,
          this._getMinDistanceInMeter(latlng)
        );
      } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
        secondLatLng = destinationOnLine(
          this._map,
          latlng,
          secondLatLng,
          this._getMaxDistanceInMeter(latlng)
        );
      }
      return secondLatLng;
    },
    _handleOuterMarkerSnapping() {
      if (this._outerMarker._snapped) {
        const latlng = this._centerMarker.getLatLng();
        const secondLatLng = this._outerMarker.getLatLng();
        const distance2 = this._distanceCalculation(latlng, secondLatLng);
        if (this.options[this._minRadiusOption] && distance2 < this.options[this._minRadiusOption]) {
          this._outerMarker.setLatLng(this._outerMarker._orgLatLng);
        } else if (this.options[this._maxRadiusOption] && distance2 > this.options[this._maxRadiusOption]) {
          this._outerMarker.setLatLng(this._outerMarker._orgLatLng);
        }
      }
      this._outerMarker.setLatLng(this._getNewDestinationOfOuterMarker());
    },
    _distanceCalculation(A, B3) {
      return this._map.project(A).distanceTo(this._map.project(B3));
    },
    _getMinDistanceInMeter(latlng) {
      return L.PM.Utils.pxRadiusToMeterRadius(
        this.options[this._minRadiusOption],
        this._map,
        latlng
      );
    },
    _getMaxDistanceInMeter(latlng) {
      return L.PM.Utils.pxRadiusToMeterRadius(
        this.options[this._maxRadiusOption],
        this._map,
        latlng
      );
    },
    _onVertexClick(e) {
      const vertex = e.target;
      if (vertex._dragging) {
        return;
      }
      this._fireVertexClick(e, void 0);
    }
  });

  // src/js/Edit/L.PM.Edit.Circle.ts
  L_PM_Edit_default.Circle = L_PM_Edit_default.CircleMarker.extend({
    _shape: "Circle",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
      this._minRadiusOption = "minRadiusCircle";
      this._maxRadiusOption = "maxRadiusCircle";
      this._editableOption = "resizeableCircle";
      this._updateHiddenPolyCircle();
    },
    enable(options) {
      L.PM.Edit.CircleMarker.prototype.enable.call(this, options || {});
    },
    _extendingEnable() {
    },
    _extendingDisable() {
      this._layer.off("remove", this.disable, this);
      const el = this._layer._path ? this._layer._path : this._layer._renderer._container;
      L.DomUtil.removeClass(el, "leaflet-pm-draggable");
    },
    _extendingApplyOptions() {
    },
    _syncMarkers() {
    },
    _removeMarker() {
    },
    _onDragStart() {
    },
    _extedingMarkerDragEnd() {
    },
    _updateHiddenPolyCircle() {
      const crsSimple = this._map && this._map.pm._isCRSSimple();
      if (this._hiddenPolyCircle) {
        this._hiddenPolyCircle.setLatLngs(
          L.PM.Utils.circleToPolygon(this._layer, 200, !crsSimple).getLatLngs()
        );
      } else {
        this._hiddenPolyCircle = L.PM.Utils.circleToPolygon(
          this._layer,
          200,
          !crsSimple
        );
      }
      if (!this._hiddenPolyCircle._parentCopy) {
        this._hiddenPolyCircle._parentCopy = this._layer;
      }
    },
    _distanceCalculation(A, B3) {
      return this._map.distance(A, B3);
    },
    _getMinDistanceInMeter() {
      return this.options[this._minRadiusOption];
    },
    _getMaxDistanceInMeter() {
      return this.options[this._maxRadiusOption];
    },
    _onVertexClick(e) {
      const vertex = e.target;
      if (vertex._dragging) {
        return;
      }
      this._fireVertexClick(e, void 0);
    }
  });

  // src/js/Edit/L.PM.Edit.ImageOverlay.ts
  L_PM_Edit_default.ImageOverlay = L_PM_Edit_default.extend({
    _shape: "ImageOverlay",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
    },
    toggleEdit(options) {
      if (!this.enabled()) {
        this.enable(options);
      } else {
        this.disable();
      }
    },
    enabled() {
      return this._enabled;
    },
    // TODO: remove default option in next major Release
    enable(options = {
      draggable: true,
      snappable: true
    }) {
      L.Util.setOptions(this, options);
      this._map = this._layer._map;
      if (!this._map) {
        return;
      }
      if (!this.options.allowEditing) {
        this.disable();
        return;
      }
      if (!this.enabled()) {
        this.disable();
      }
      this.enableLayerDrag();
      this._layer.on("remove", this.disable, this);
      this._enabled = true;
      this._otherSnapLayers = this._findCorners();
      this._fireEnable();
    },
    disable() {
      if (this._dragging) {
        return;
      }
      if (!this._map) {
        this._map = this._layer._map;
      }
      this.disableLayerDrag();
      this._layer.off("remove", this.disable, this);
      if (!this.enabled()) {
        if (this._layerEdited) {
          this._fireUpdate();
        }
        this._layerEdited = false;
        this._fireDisable();
      }
      this._enabled = false;
    },
    _findCorners() {
      const corners = this._layer.getBounds();
      const northwest = corners.getNorthWest();
      const northeast = corners.getNorthEast();
      const southeast = corners.getSouthEast();
      const southwest = corners.getSouthWest();
      return [northwest, northeast, southeast, southwest];
    }
  });

  // src/js/Edit/L.PM.Edit.Text.ts
  L_PM_Edit_default.Text = L_PM_Edit_default.extend({
    _shape: "Text",
    initialize(layer) {
      this._layer = layer;
      this._enabled = false;
    },
    enable(options) {
      L.Util.setOptions(this, options);
      if (!this.textArea) {
        return;
      }
      if (!this.options.allowEditing || !this._layer._map) {
        this.disable();
        return;
      }
      this._map = this._layer._map;
      if (this.enabled()) {
        this.disable();
      }
      this.applyOptions();
      this._safeToCacheDragState = true;
      this._focusChange();
      this.textArea.readOnly = false;
      this.textArea.classList.remove("pm-disabled");
      this._layer.on("remove", this.disable, this);
      L.DomEvent.on(this.textArea, "input", this._autoResize, this);
      L.DomEvent.on(this.textArea, "focus", this._focusChange, this);
      L.DomEvent.on(this.textArea, "blur", this._focusChange, this);
      this._layer.on("dblclick", L.DomEvent.stop);
      L.DomEvent.off(this.textArea, "mousedown", this._preventTextSelection);
      this._enabled = true;
      this._fireEnable();
    },
    disable() {
      if (!this.enabled()) {
        return;
      }
      this._layer.off("remove", this.disable, this);
      L.DomEvent.off(this.textArea, "input", this._autoResize, this);
      L.DomEvent.off(this.textArea, "focus", this._focusChange, this);
      L.DomEvent.off(this.textArea, "blur", this._focusChange, this);
      document.removeEventListener("click", this._documentClickThis, {
        capture: true
      });
      this._focusChange();
      this.textArea.readOnly = true;
      this.textArea.classList.add("pm-disabled");
      const focusedElement = document.activeElement;
      this.textArea.focus();
      this.textArea.selectionStart = 0;
      this.textArea.selectionEnd = 0;
      L.DomEvent.on(this.textArea, "mousedown", this._preventTextSelection);
      focusedElement.focus();
      this._disableOnBlurActive = false;
      if (this._layerEdited) {
        this._fireUpdate();
      }
      this._layerEdited = false;
      this._fireDisable();
      this._enabled = false;
    },
    enabled() {
      return this._enabled;
    },
    toggleEdit(options) {
      if (!this.enabled()) {
        this.enable(options);
      } else {
        this.disable();
      }
    },
    applyOptions() {
      if (this.options.snappable) {
        this._initSnappableMarkers();
      } else {
        this._disableSnapping();
      }
    },
    // overwrite initSnappableMarkers from Snapping.js Mixin
    _initSnappableMarkers() {
      const marker = this._layer;
      this.options.snapDistance = this.options.snapDistance || 30;
      this.options.snapSegment = this.options.snapSegment === void 0 ? true : this.options.snapSegment;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.on("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.on("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
      marker.on("pm:dragstart", this._unsnap, this);
    },
    _disableSnapping() {
      const marker = this._layer;
      marker.off("pm:drag", this._handleSnapping, this);
      marker.off("pm:dragend", this._cleanupSnapping, this);
      marker.off("pm:dragstart", this._unsnap, this);
    },
    _autoResize() {
      this.textArea.style.height = "1px";
      this.textArea.style.width = "1px";
      const height = this.textArea.scrollHeight > 21 ? this.textArea.scrollHeight : 21;
      const width = this.textArea.scrollWidth > 16 ? this.textArea.scrollWidth : 16;
      this.textArea.style.height = `${height}px`;
      this.textArea.style.width = `${width}px`;
      this._layer.options.text = this.getText();
      this._fireTextChange(this.getText());
    },
    _disableOnBlur() {
      this._disableOnBlurActive = true;
      setTimeout(() => {
        if (this.enabled()) {
          this._documentClickThis = this._documentClickThis || this._documentClick.bind(this);
          document.addEventListener("click", this._documentClickThis, {
            capture: true
          });
        }
      }, 100);
    },
    _documentClick(e) {
      if (e.target !== this.textArea) {
        this.disable();
        if (!this.getText() && this.options.removeIfEmpty) {
          this.remove();
        }
      }
    },
    _focusChange(e = {}) {
      const focusAlreadySet = this._hasFocus;
      this._hasFocus = e.type === "focus";
      if (!focusAlreadySet !== !this._hasFocus) {
        if (this._hasFocus) {
          this._applyFocus();
          this._focusText = this.getText();
          this._fireTextFocus();
        } else {
          this._removeFocus();
          this._fireTextBlur();
          if (this._focusText !== this.getText()) {
            this._fireEdit();
            this._layerEdited = true;
          }
        }
      }
    },
    _applyFocus() {
      this.textArea.classList.add("pm-hasfocus");
      if (this._map.dragging) {
        if (this._safeToCacheDragState) {
          this._originalMapDragState = this._map.dragging._enabled;
          this._safeToCacheDragState = false;
        }
        this._map.dragging.disable();
      }
    },
    _removeFocus() {
      if (this._map.dragging) {
        if (this._originalMapDragState) {
          this._map.dragging.enable();
        }
        this._safeToCacheDragState = true;
      }
      this.textArea.classList.remove("pm-hasfocus");
    },
    focus() {
      if (!this.enabled()) {
        throw new TypeError("Layer is not enabled");
      }
      this.textArea.focus();
    },
    blur() {
      if (!this.enabled()) {
        throw new TypeError("Layer is not enabled");
      }
      this.textArea.blur();
      if (this._disableOnBlurActive) {
        this.disable();
      }
    },
    hasFocus() {
      return this._hasFocus;
    },
    getElement() {
      return this.textArea;
    },
    setText(text) {
      if (text !== void 0) {
        this.textArea.value = text;
      }
      this._autoResize();
    },
    getText() {
      return this.textArea.value;
    },
    _initTextMarker() {
      this.textArea = L.PM.Draw.Text.prototype._createTextArea.call(this);
      if (this.options.className) {
        const cssClasses = this.options.className.split(" ");
        this.textArea.classList.add(...cssClasses);
      }
      const textAreaIcon = L.PM.Draw.Text.prototype._createTextIcon.call(
        this,
        this.textArea
      );
      this._layer.setIcon(textAreaIcon);
      this._layer.once("add", this._createTextMarker, this);
    },
    _createTextMarker(enable = false) {
      this._layer.off("add", this._createTextMarker, this);
      this._layer.getElement().tabIndex = -1;
      this.textArea.wrap = "off";
      this.textArea.style.overflow = "hidden";
      this.textArea.style.height = L.DomUtil.getStyle(
        this.textArea,
        "font-size"
      );
      this.textArea.style.width = "1px";
      if (this._layer.options.text) {
        this.setText(this._layer.options.text);
      }
      this._autoResize();
      if (enable === true) {
        this.enable();
        this.focus();
        this._disableOnBlur();
      }
    },
    // Chrome ignores `user-select: none`, so we need to disable text selection manually
    _preventTextSelection(e) {
      e.preventDefault();
    }
  });

  // src/js/helpers/Matrix.ts
  var Matrix = function Matrix2(a, b, c, d, e, f) {
    this._matrix = [a, b, c, d, e, f];
  };
  Matrix.init = () => new L.PM.Matrix(1, 0, 0, 1, 0, 0);
  Matrix.prototype = {
    /**
     * @param  {L.Point} point
     * @return {L.Point}
     */
    transform(point2) {
      return this._transform(point2.clone());
    },
    /**
     * Destructive
     *
     * [ x ] = [ a  b  tx ] [ x ] = [ a * x + b * y + tx ]
     * [ y ] = [ c  d  ty ] [ y ] = [ c * x + d * y + ty ]
     *
     * @param  {L.Point} point
     * @return {L.Point}
     */
    _transform(point2) {
      const matrix = this._matrix;
      const { x, y } = point2;
      point2.x = matrix[0] * x + matrix[1] * y + matrix[4];
      point2.y = matrix[2] * x + matrix[3] * y + matrix[5];
      return point2;
    },
    /**
     * @param  {L.Point} point
     * @return {L.Point}
     */
    untransform(point2) {
      const matrix = this._matrix;
      return new L.Point(
        (point2.x / matrix[0] - matrix[4]) / matrix[0],
        (point2.y / matrix[2] - matrix[5]) / matrix[2]
      );
    },
    /**
     * @return {L.PM.Matrix}
     */
    clone() {
      const matrix = this._matrix;
      return new L.PM.Matrix(
        matrix[0],
        matrix[1],
        matrix[2],
        matrix[3],
        matrix[4],
        matrix[5]
      );
    },
    /**
     * @param {L.Point|Number} translate
     * @return {L.PM.Matrix|L.Point}
     */
    translate(translate) {
      if (translate === void 0) {
        return new L.Point(this._matrix[4], this._matrix[5]);
      }
      let translateX;
      let translateY;
      if (typeof translate === "number") {
        translateX = translate;
        translateY = translate;
      } else {
        translateX = translate.x;
        translateY = translate.y;
      }
      return this._add(1, 0, 0, 1, translateX, translateY);
    },
    /**
     * @param {L.Point|Number} scale
     * @param {L.Point|Number} origin
     * @return {L.PM.Matrix|L.Point}
     */
    scale(scale3, origin) {
      if (scale3 === void 0) {
        return new L.Point(this._matrix[0], this._matrix[3]);
      }
      let scaleX;
      let scaleY;
      origin = origin || L.point(0, 0);
      if (typeof scale3 === "number") {
        scaleX = scale3;
        scaleY = scale3;
      } else {
        scaleX = scale3.x;
        scaleY = scale3.y;
      }
      return this._add(scaleX, 0, 0, scaleY, origin.x, origin.y)._add(
        1,
        0,
        0,
        1,
        -origin.x,
        -origin.y
      );
    },
    /**
     * m00  m01  x - m00 * x - m01 * y
     * m10  m11  y - m10 * x - m11 * y
     * @param {Number}   angle
     * @param {L.Point=} origin
     * @return {L.PM.Matrix}
     */
    rotate(angle, origin) {
      const cos = Math.cos(angle);
      const sin = Math.sin(angle);
      origin = origin || new L.Point(0, 0);
      return this._add(cos, sin, -sin, cos, origin.x, origin.y)._add(
        1,
        0,
        0,
        1,
        -origin.x,
        -origin.y
      );
    },
    /**
     * Invert rotation
     * @return {L.PM.Matrix}
     */
    flip() {
      this._matrix[1] *= -1;
      this._matrix[2] *= -1;
      return this;
    },
    /**
     * @param {Number|L.PM.Matrix} a
     * @param {Number} b
     * @param {Number} c
     * @param {Number} d
     * @param {Number} e
     * @param {Number} f
     */
    _add(a, b, c, d, e, f) {
      const result = [[], [], []];
      let src = this._matrix;
      const m = [
        [src[0], src[2], src[4]],
        [src[1], src[3], src[5]],
        [0, 0, 1]
      ];
      let other = [
        [a, c, e],
        [b, d, f],
        [0, 0, 1]
      ];
      let val;
      if (a && a instanceof L.PM.Matrix) {
        src = a._matrix;
        other = [
          [src[0], src[2], src[4]],
          [src[1], src[3], src[5]],
          [0, 0, 1]
        ];
      }
      for (let i = 0; i < 3; i += 1) {
        for (let j = 0; j < 3; j += 1) {
          val = 0;
          for (let k = 0; k < 3; k += 1) {
            val += m[i][k] * other[k][j];
          }
          result[i][j] = val;
        }
      }
      this._matrix = [
        result[0][0],
        result[1][0],
        result[0][1],
        result[1][1],
        result[0][2],
        result[1][2]
      ];
      return this;
    }
  };
  var Matrix_default = Matrix;

  // src/js/L.PM.Utils.ts
  var Utils = {
    calcMiddleLatLng(map, latlng1, latlng2) {
      const p1 = map.project(latlng1);
      const p2 = map.project(latlng2);
      return map.unproject(p1._add(p2)._divideBy(2));
    },
    findLayers(map) {
      let layers = [];
      map.eachLayer((layer) => {
        if (layer instanceof L.Polyline || layer instanceof L.Marker || layer instanceof L.Circle || layer instanceof L.CircleMarker || layer instanceof L.ImageOverlay) {
          layers.push(layer);
        }
      });
      layers = layers.filter((layer) => !!layer.pm);
      layers = layers.filter((layer) => !layer._pmTempLayer);
      layers = layers.filter(
        (layer) => !L.PM.optIn && !layer.options.pmIgnore || // if optIn is not set / true and pmIgnore is not set / true (default)
        L.PM.optIn && layer.options.pmIgnore === false
        // if optIn is true and pmIgnore is false);
      );
      return layers;
    },
    circleToPolygon(circle, sides = 60, withBearing = true) {
      const origin = circle.getLatLng();
      const radius = circle.getRadius();
      const polys = createGeodesicPolygon(origin, radius, sides, 0, withBearing);
      const polygon = [];
      for (let i = 0; i < polys.length; i += 1) {
        const geometry = [polys[i].lat, polys[i].lng];
        polygon.push(geometry);
      }
      return L.polygon(polygon, circle.options);
    },
    disablePopup(layer) {
      if (layer.getPopup()) {
        layer._tempPopupCopy = layer.getPopup();
        layer.unbindPopup();
      }
    },
    enablePopup(layer) {
      if (layer._tempPopupCopy) {
        layer.bindPopup(layer._tempPopupCopy);
        delete layer._tempPopupCopy;
      }
    },
    _fireEvent(layer, type, data, propagate = false) {
      layer.fire(type, data, propagate);
      const { groups } = this.getAllParentGroups(layer);
      groups.forEach((group) => {
        group.fire(type, data, propagate);
      });
    },
    getAllParentGroups(layer) {
      const groupIds = [];
      const groups = [];
      const loopThroughParents = (_layer) => {
        for (const _id in _layer._eventParents) {
          if (groupIds.indexOf(_id) === -1) {
            groupIds.push(_id);
            const group = _layer._eventParents[_id];
            groups.push(group);
            loopThroughParents(group);
          }
        }
      };
      if (!layer._pmLastGroupFetch || !layer._pmLastGroupFetch.time || (/* @__PURE__ */ new Date()).getTime() - layer._pmLastGroupFetch.time > 1e3) {
        loopThroughParents(layer);
        layer._pmLastGroupFetch = {
          time: (/* @__PURE__ */ new Date()).getTime(),
          groups,
          groupIds
        };
        return {
          groupIds,
          groups
        };
      }
      return {
        groups: layer._pmLastGroupFetch.groups,
        groupIds: layer._pmLastGroupFetch.groupIds
      };
    },
    createGeodesicPolygon,
    getTranslation,
    findDeepCoordIndex(arr, latlng, exact = true) {
      let result;
      const run = (path) => (v3, i) => {
        const iRes = path.concat(i);
        if (exact) {
          if (v3.lat && v3.lat === latlng.lat && v3.lng === latlng.lng) {
            result = iRes;
            return true;
          }
        } else if (v3.lat && L.latLng(v3).equals(latlng)) {
          result = iRes;
          return true;
        }
        return Array.isArray(v3) && v3.some(run(iRes));
      };
      arr.some(run([]));
      let returnVal = {};
      if (result) {
        returnVal = {
          indexPath: result,
          index: result[result.length - 1],
          parentPath: result.slice(0, result.length - 1)
        };
      }
      return returnVal;
    },
    findDeepMarkerIndex(arr, marker) {
      let result;
      const run = (path) => (v3, i) => {
        const iRes = path.concat(i);
        if (v3._leaflet_id === marker._leaflet_id) {
          result = iRes;
          return true;
        }
        return Array.isArray(v3) && v3.some(run(iRes));
      };
      arr.some(run([]));
      let returnVal = {};
      if (result) {
        returnVal = {
          indexPath: result,
          index: result[result.length - 1],
          parentPath: result.slice(0, result.length - 1)
        };
      }
      return returnVal;
    },
    _getIndexFromSegment(coords, segment) {
      if (segment && segment.length === 2) {
        const indexA = this.findDeepCoordIndex(coords, segment[0]);
        const indexB = this.findDeepCoordIndex(coords, segment[1]);
        let newIndex = Math.max(indexA.index, indexB.index);
        if ((indexA.index === 0 || indexB.index === 0) && newIndex !== 1) {
          newIndex += 1;
        }
        return {
          indexA,
          indexB,
          newIndex,
          indexPath: indexA.indexPath,
          parentPath: indexA.parentPath
        };
      }
      return null;
    },
    // Returns the corners of the rectangle with a given rotation
    // degrees: Between marker A and the marker counterclockwise before. Same for marker B
    _getRotatedRectangle(A, B3, rotation, map) {
      const startPoint = _toPoint(map, A);
      const endPoint = _toPoint(map, B3);
      const theta = rotation * Math.PI / 180;
      const cos = Math.cos(theta);
      const sin = Math.sin(theta);
      const width = (endPoint.x - startPoint.x) * cos + (endPoint.y - startPoint.y) * sin;
      const height = (endPoint.y - startPoint.y) * cos - (endPoint.x - startPoint.x) * sin;
      const x0 = width * cos + startPoint.x;
      const y0 = width * sin + startPoint.y;
      const x1 = -height * sin + startPoint.x;
      const y1 = height * cos + startPoint.y;
      const p0 = _toLatLng(map, startPoint);
      const p1 = _toLatLng(map, { x: x0, y: y0 });
      const p2 = _toLatLng(map, endPoint);
      const p3 = _toLatLng(map, { x: x1, y: y1 });
      return [p0, p1, p2, p3];
    },
    pxRadiusToMeterRadius(radiusInPx, map, center) {
      const pointA = map.project(center);
      const pointB = L.point(pointA.x + radiusInPx, pointA.y);
      return map.distance(map.unproject(pointB), center);
    }
  };
  var L_PM_Utils_default = Utils;

  // src/js/L.PM.ts
  L.PM = L.PM || {
    version: package_default.version,
    Map: L_PM_Map_default,
    Toolbar: L_PM_Toolbar_default,
    Draw: L_PM_Draw_default,
    Edit: L_PM_Edit_default,
    Utils: L_PM_Utils_default,
    Matrix: Matrix_default,
    activeLang: "en",
    optIn: false,
    initialize(options) {
      this.addInitHooks(options);
    },
    setOptIn(value) {
      this.optIn = !!value;
    },
    addInitHooks() {
      function initMap() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Map(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Map(this);
        }
        if (this.pm) {
          this.pm.setGlobalOptions({});
        }
      }
      L.Map.addInitHook(initMap);
      function initLayerGroup() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.LayerGroup(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.LayerGroup(this);
        }
      }
      L.LayerGroup.addInitHook(initLayerGroup);
      function initMarker() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            if (this.options.textMarker) {
              this.pm = new L.PM.Edit.Text(this);
              if (!this.options._textMarkerOverPM) {
                this.pm._initTextMarker();
              }
              delete this.options._textMarkerOverPM;
            } else {
              this.pm = new L.PM.Edit.Marker(this);
            }
          }
        } else if (!this.options.pmIgnore) {
          if (this.options.textMarker) {
            this.pm = new L.PM.Edit.Text(this);
            if (!this.options._textMarkerOverPM) {
              this.pm._initTextMarker();
            }
            delete this.options._textMarkerOverPM;
          } else {
            this.pm = new L.PM.Edit.Marker(this);
          }
        }
      }
      L.Marker.addInitHook(initMarker);
      function initCircleMarker() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.CircleMarker(
              this
            );
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.CircleMarker(this);
        }
      }
      L.CircleMarker.addInitHook(initCircleMarker);
      function initPolyline() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.Line(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.Line(this);
        }
      }
      L.Polyline.addInitHook(initPolyline);
      function initPolygon() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.Polygon(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.Polygon(this);
        }
      }
      L.Polygon.addInitHook(initPolygon);
      function initRectangle() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.Rectangle(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.Rectangle(this);
        }
      }
      L.Rectangle.addInitHook(initRectangle);
      function initCircle() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.Circle(this);
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.Circle(this);
        }
      }
      L.Circle.addInitHook(initCircle);
      function initImageOverlay() {
        this.pm = void 0;
        if (L.PM.optIn) {
          if (this.options.pmIgnore === false) {
            this.pm = new L.PM.Edit.ImageOverlay(
              this
            );
          }
        } else if (!this.options.pmIgnore) {
          this.pm = new L.PM.Edit.ImageOverlay(this);
        }
      }
      L.ImageOverlay.addInitHook(initImageOverlay);
    },
    reInitLayer(layer) {
      if (layer instanceof L.LayerGroup) {
        layer.eachLayer((_layer) => {
          this.reInitLayer(_layer);
        });
      }
      if (layer.pm) {
      } else if (L.PM.optIn && layer.options.pmIgnore !== false) {
      } else if (layer.options.pmIgnore) {
      } else if (layer instanceof L.Map) {
        layer.pm = new L.PM.Map(layer);
      } else if (layer instanceof L.Marker) {
        if (layer.options.textMarker) {
          layer.pm = new L.PM.Edit.Text(layer);
          layer.pm._initTextMarker();
          layer.pm._createTextMarker(false);
        } else {
          layer.pm = new L.PM.Edit.Marker(layer);
        }
      } else if (layer instanceof L.Circle) {
        layer.pm = new L.PM.Edit.Circle(layer);
      } else if (layer instanceof L.CircleMarker) {
        layer.pm = new L.PM.Edit.CircleMarker(
          layer
        );
      } else if (layer instanceof L.Rectangle) {
        layer.pm = new L.PM.Edit.Rectangle(layer);
      } else if (layer instanceof L.Polygon) {
        layer.pm = new L.PM.Edit.Polygon(layer);
      } else if (layer instanceof L.Polyline) {
        layer.pm = new L.PM.Edit.Line(layer);
      } else if (layer instanceof L.LayerGroup) {
        layer.pm = new L.PM.Edit.LayerGroup(layer);
      } else if (layer instanceof L.ImageOverlay) {
        layer.pm = new L.PM.Edit.ImageOverlay(
          layer
        );
      }
    }
  };
  if (L.version === "1.7.1") {
    L.Canvas.include({
      _onClick(e) {
        const point2 = this._map.mouseEventToLayerPoint(e);
        let layer;
        let clickedLayer;
        for (let order = this._drawFirst; order; order = order.next) {
          layer = order.layer;
          if (layer.options.interactive && layer._containsPoint(point2)) {
            if (!(e.type === "click" || e.type === "preclick") || !this._map._draggableMoved(layer)) {
              clickedLayer = layer;
            }
          }
        }
        if (clickedLayer) {
          L.DomEvent.fakeStop(e);
          this._fireEvent([clickedLayer], e);
        }
      }
    });
  }
  L.PM.initialize();
})();
//# sourceMappingURL=leaflet-geoman.js.map
