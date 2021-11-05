/* Polyfill service v3.108.0
 * For detailed credits and licence information see https://github.com/financial-times/polyfill-service.
 * 
 * Features requested: Array.prototype.includes,DocumentFragment.prototype.append,Element.prototype.append,Math.hypot,Object.assign,Promise,Promise.prototype.finally,Reflect,Reflect.apply,Reflect.construct,Reflect.defineProperty,Reflect.deleteProperty,Reflect.get,Reflect.getOwnPropertyDescriptor,Reflect.getPrototypeOf,Reflect.has,Reflect.isExtensible,Reflect.ownKeys,Reflect.preventExtensions,Reflect.set,Reflect.setPrototypeOf,String.prototype.includes
 * 
 * - _ESAbstract.Call, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive", "_ESAbstract.OrdinaryToPrimitive")
 * - _ESAbstract.CreateMethodProperty, License: CC0 (required by "Reflect.setPrototypeOf", "Object.setPrototypeOf")
 * - _ESAbstract.Get, License: CC0 (required by "Reflect.construct", "_ESAbstract.Construct", "_ESAbstract.OrdinaryCreateFromConstructor", "_ESAbstract.GetPrototypeFromConstructor")
 * - _ESAbstract.HasOwnProperty, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor")
 * - _ESAbstract.HasProperty, License: CC0 (required by "Reflect.defineProperty", "_ESAbstract.ToPropertyDescriptor")
 * - _ESAbstract.IsCallable, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive", "_ESAbstract.OrdinaryToPrimitive")
 * - _ESAbstract.RequireObjectCoercible, License: CC0 (required by "String.prototype.includes")
 * - _ESAbstract.SameValueNonNumber, License: CC0 (required by "Array.prototype.includes", "_ESAbstract.SameValueZero")
 * - _ESAbstract.ToBoolean, License: CC0 (required by "String.prototype.includes", "_ESAbstract.IsRegExp")
 * - _ESAbstract.ToObject, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive", "_ESAbstract.GetMethod", "_ESAbstract.GetV")
 * - _ESAbstract.GetV, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive", "_ESAbstract.GetMethod")
 * - _ESAbstract.GetMethod, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive")
 * - _ESAbstract.Type, License: CC0 (required by "Reflect.construct", "_ESAbstract.Construct", "_ESAbstract.OrdinaryCreateFromConstructor", "_ESAbstract.GetPrototypeFromConstructor")
 * - _ESAbstract.GetPrototypeFromConstructor, License: CC0 (required by "Reflect.construct", "_ESAbstract.Construct", "_ESAbstract.OrdinaryCreateFromConstructor")
 * - _ESAbstract.OrdinaryCreateFromConstructor, License: CC0 (required by "Reflect.construct", "_ESAbstract.Construct")
 * - _ESAbstract.IsConstructor, License: CC0 (required by "Reflect.construct", "_ESAbstract.Construct")
 * - _ESAbstract.Construct, License: CC0 (required by "Reflect.construct")
 * - _ESAbstract.IsRegExp, License: CC0 (required by "String.prototype.includes")
 * - _ESAbstract.OrdinaryToPrimitive, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey", "_ESAbstract.ToPrimitive")
 * - _ESAbstract.SameValueZero, License: CC0 (required by "Array.prototype.includes")
 * - _ESAbstract.ToInteger, License: CC0 (required by "Array.prototype.includes", "_ESAbstract.ToLength")
 * - _ESAbstract.ToLength, License: CC0 (required by "Reflect.construct", "_ESAbstract.CreateListFromArrayLike")
 * - _ESAbstract.ToPrimitive, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey")
 * - _ESAbstract.ToPropertyDescriptor, License: CC0 (required by "Reflect.defineProperty")
 * - _ESAbstract.ToString, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor", "_ESAbstract.ToPropertyKey")
 * - _ESAbstract.ToPropertyKey, License: CC0 (required by "Reflect.getOwnPropertyDescriptor", "Object.getOwnPropertyDescriptor")
 * - _mutation, License: CC0 (required by "Element.prototype.append")
 * - Array.prototype.includes, License: MIT (required by "Promise", "Symbol.toStringTag", "Symbol", "Object.getOwnPropertyNames")
 * - _ESAbstract.CreateListFromArrayLike, License: CC0 (required by "Reflect.construct")
 * - DocumentFragment, License: CC0 (required by "DocumentFragment.prototype.append")
 * - DocumentFragment.prototype.append, License: CC0
 * - Element.prototype.append, License: CC0
 * - Math.hypot, License: CC0
 * - Object.getOwnPropertyDescriptor, License: CC0 (required by "Reflect.setPrototypeOf", "Object.setPrototypeOf")
 * - Object.isExtensible, License: CC0 (required by "Reflect.isExtensible")
 * - Object.keys, License: MIT (required by "Promise", "Symbol.toStringTag", "Symbol", "Object.getOwnPropertyNames")
 * - Object.assign, License: CC0
 * - Object.getOwnPropertyNames, License: CC0 (required by "Reflect.setPrototypeOf", "Object.setPrototypeOf")
 * - Object.setPrototypeOf, License: MIT (required by "Reflect.setPrototypeOf")
 * - Reflect, License: CC0 (required by "Reflect.setPrototypeOf")
 * - Reflect.apply, License: CC0
 * - Reflect.construct, License: CC0
 * - Reflect.defineProperty, License: CC0
 * - Reflect.deleteProperty, License: CC0
 * - Reflect.get, License: CC0
 * - Reflect.getOwnPropertyDescriptor, License: CC0
 * - Reflect.getPrototypeOf, License: CC0 (required by "Reflect.setPrototypeOf")
 * - Reflect.has, License: CC0
 * - Reflect.isExtensible, License: CC0
 * - Reflect.preventExtensions, License: CC0
 * - Reflect.set, License: CC0
 * - Reflect.setPrototypeOf, License: CC0
 * - String.prototype.includes, License: CC0
 * - Symbol, License: MIT (required by "Promise", "Symbol.toStringTag")
 * - Reflect.ownKeys, License: CC0
 * - Symbol.toStringTag, License: MIT (required by "Promise")
 * - Promise, License: MIT */

(function(self, undefined) {

// _ESAbstract.Call
/* global IsCallable */
// 7.3.12. Call ( F, V [ , argumentsList ] )
function Call(F, V /* [, argumentsList] */) { // eslint-disable-line no-unused-vars
	// 1. If argumentsList is not present, set argumentsList to a new empty List.
	var argumentsList = arguments.length > 2 ? arguments[2] : [];
	// 2. If IsCallable(F) is false, throw a TypeError exception.
	if (IsCallable(F) === false) {
		throw new TypeError(Object.prototype.toString.call(F) + 'is not a function.');
	}
	// 3. Return ? F.[[Call]](V, argumentsList).
	return F.apply(V, argumentsList);
}

// _ESAbstract.CreateMethodProperty
// 7.3.5. CreateMethodProperty ( O, P, V )
function CreateMethodProperty(O, P, V) { // eslint-disable-line no-unused-vars
	// 1. Assert: Type(O) is Object.
	// 2. Assert: IsPropertyKey(P) is true.
	// 3. Let newDesc be the PropertyDescriptor{[[Value]]: V, [[Writable]]: true, [[Enumerable]]: false, [[Configurable]]: true}.
	var newDesc = {
		value: V,
		writable: true,
		enumerable: false,
		configurable: true
	};
	// 4. Return ? O.[[DefineOwnProperty]](P, newDesc).
	Object.defineProperty(O, P, newDesc);
}

// _ESAbstract.Get
// 7.3.1. Get ( O, P )
function Get(O, P) { // eslint-disable-line no-unused-vars
	// 1. Assert: Type(O) is Object.
	// 2. Assert: IsPropertyKey(P) is true.
	// 3. Return ? O.[[Get]](P, O).
	return O[P];
}

// _ESAbstract.HasOwnProperty
// 7.3.11 HasOwnProperty (O, P)
function HasOwnProperty(o, p) { // eslint-disable-line no-unused-vars
	// 1. Assert: Type(O) is Object.
	// 2. Assert: IsPropertyKey(P) is true.
	// 3. Let desc be ? O.[[GetOwnProperty]](P).
	// 4. If desc is undefined, return false.
	// 5. Return true.
	// Polyfill.io - As we expect user agents to support ES3 fully we can skip the above steps and use Object.prototype.hasOwnProperty to do them for us.
	return Object.prototype.hasOwnProperty.call(o, p);
}

// _ESAbstract.HasProperty
// 7.3.10. HasProperty ( O, P )
function HasProperty(O, P) { // eslint-disable-line no-unused-vars
	// Assert: Type(O) is Object.
	// Assert: IsPropertyKey(P) is true.
	// Return ? O.[[HasProperty]](P).
	return P in O;
}

// _ESAbstract.IsCallable
// 7.2.3. IsCallable ( argument )
function IsCallable(argument) { // eslint-disable-line no-unused-vars
	// 1. If Type(argument) is not Object, return false.
	// 2. If argument has a [[Call]] internal method, return true.
	// 3. Return false.

	// Polyfill.io - Only function objects have a [[Call]] internal method. This means we can simplify this function to check that the argument has a type of function.
	return typeof argument === 'function';
}

// _ESAbstract.RequireObjectCoercible
// 7.2.1. RequireObjectCoercible ( argument )
// The abstract operation ToObject converts argument to a value of type Object according to Table 12:
// Table 12: ToObject Conversions
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------|
| Argument Type | Result                                                                                                                             |
|----------------------------------------------------------------------------------------------------------------------------------------------------|
| Undefined     | Throw a TypeError exception.                                                                                                       |
| Null          | Throw a TypeError exception.                                                                                                       |
| Boolean       | Return argument.                                                                                                                   |
| Number        | Return argument.                                                                                                                   |
| String        | Return argument.                                                                                                                   |
| Symbol        | Return argument.                                                                                                                   |
| Object        | Return argument.                                                                                                                   |
|----------------------------------------------------------------------------------------------------------------------------------------------------|
*/
function RequireObjectCoercible(argument) { // eslint-disable-line no-unused-vars
	if (argument === null || argument === undefined) {
		throw TypeError(Object.prototype.toString.call(argument) + ' is not coercible to Object.');
	}
	return argument;
}

// _ESAbstract.SameValueNonNumber
// 7.2.12. SameValueNonNumber ( x, y )
function SameValueNonNumber(x, y) { // eslint-disable-line no-unused-vars
	// 1. Assert: Type(x) is not Number.
	// 2. Assert: Type(x) is the same as Type(y).
	// 3. If Type(x) is Undefined, return true.
	// 4. If Type(x) is Null, return true.
	// 5. If Type(x) is String, then
		// a. If x and y are exactly the same sequence of code units (same length and same code units at corresponding indices), return true; otherwise, return false.
	// 6. If Type(x) is Boolean, then
		// a. If x and y are both true or both false, return true; otherwise, return false.
	// 7. If Type(x) is Symbol, then
		// a. If x and y are both the same Symbol value, return true; otherwise, return false.
	// 8. If x and y are the same Object value, return true. Otherwise, return false.

	// Polyfill.io - We can skip all above steps because the === operator does it all for us.
	return x === y;
}

// _ESAbstract.ToBoolean
// 7.1.2. ToBoolean ( argument )
// The abstract operation ToBoolean converts argument to a value of type Boolean according to Table 9:
/*
--------------------------------------------------------------------------------------------------------------
| Argument Type | Result                                                                                     |
--------------------------------------------------------------------------------------------------------------
| Undefined     | Return false.                                                                              |
| Null          | Return false.                                                                              |
| Boolean       | Return argument.                                                                           |
| Number        | If argument is +0, -0, or NaN, return false; otherwise return true.                        |
| String        | If argument is the empty String (its length is zero), return false; otherwise return true. |
| Symbol        | Return true.                                                                               |
| Object        | Return true.                                                                               |
--------------------------------------------------------------------------------------------------------------
*/
function ToBoolean(argument) { // eslint-disable-line no-unused-vars
	return Boolean(argument);
}

// _ESAbstract.ToObject
// 7.1.13 ToObject ( argument )
// The abstract operation ToObject converts argument to a value of type Object according to Table 12:
// Table 12: ToObject Conversions
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------|
| Argument Type | Result                                                                                                                             |
|----------------------------------------------------------------------------------------------------------------------------------------------------|
| Undefined     | Throw a TypeError exception.                                                                                                       |
| Null          | Throw a TypeError exception.                                                                                                       |
| Boolean       | Return a new Boolean object whose [[BooleanData]] internal slot is set to argument. See 19.3 for a description of Boolean objects. |
| Number        | Return a new Number object whose [[NumberData]] internal slot is set to argument. See 20.1 for a description of Number objects.    |
| String        | Return a new String object whose [[StringData]] internal slot is set to argument. See 21.1 for a description of String objects.    |
| Symbol        | Return a new Symbol object whose [[SymbolData]] internal slot is set to argument. See 19.4 for a description of Symbol objects.    |
| Object        | Return argument.                                                                                                                   |
|----------------------------------------------------------------------------------------------------------------------------------------------------|
*/
function ToObject(argument) { // eslint-disable-line no-unused-vars
	if (argument === null || argument === undefined) {
		throw TypeError();
	}
	return Object(argument);
}

// _ESAbstract.GetV
/* global ToObject */
// 7.3.2 GetV (V, P)
function GetV(v, p) { // eslint-disable-line no-unused-vars
	// 1. Assert: IsPropertyKey(P) is true.
	// 2. Let O be ? ToObject(V).
	var o = ToObject(v);
	// 3. Return ? O.[[Get]](P, V).
	return o[p];
}

// _ESAbstract.GetMethod
/* global GetV, IsCallable */
// 7.3.9. GetMethod ( V, P )
function GetMethod(V, P) { // eslint-disable-line no-unused-vars
	// 1. Assert: IsPropertyKey(P) is true.
	// 2. Let func be ? GetV(V, P).
	var func = GetV(V, P);
	// 3. If func is either undefined or null, return undefined.
	if (func === null || func === undefined) {
		return undefined;
	}
	// 4. If IsCallable(func) is false, throw a TypeError exception.
	if (IsCallable(func) === false) {
		throw new TypeError('Method not callable: ' + P);
	}
	// 5. Return func.
	return func;
}

// _ESAbstract.Type
// "Type(x)" is used as shorthand for "the type of x"...
function Type(x) { // eslint-disable-line no-unused-vars
	switch (typeof x) {
		case 'undefined':
			return 'undefined';
		case 'boolean':
			return 'boolean';
		case 'number':
			return 'number';
		case 'string':
			return 'string';
		case 'symbol':
			return 'symbol';
		default:
			// typeof null is 'object'
			if (x === null) return 'null';
			// Polyfill.io - This is here because a Symbol polyfill will have a typeof `object`.
			if ('Symbol' in self && (x instanceof self.Symbol || x.constructor === self.Symbol)) return 'symbol';

			return 'object';
	}
}

// _ESAbstract.GetPrototypeFromConstructor
/* global Get, Type */
// 9.1.14. GetPrototypeFromConstructor ( constructor, intrinsicDefaultProto )
function GetPrototypeFromConstructor(constructor, intrinsicDefaultProto) { // eslint-disable-line no-unused-vars
	// 1. Assert: intrinsicDefaultProto is a String value that is this specification's name of an intrinsic object. The corresponding object must be an intrinsic that is intended to be used as the [[Prototype]] value of an object.
	// 2. Assert: IsCallable(constructor) is true.
	// 3. Let proto be ? Get(constructor, "prototype").
	var proto = Get(constructor, "prototype");
	// 4. If Type(proto) is not Object, then
	if (Type(proto) !== 'object') {
		// a. Let realm be ? GetFunctionRealm(constructor).
		// b. Set proto to realm's intrinsic object named intrinsicDefaultProto.
		proto = intrinsicDefaultProto;
	}
	// 5. Return proto.
	return proto;
}

// _ESAbstract.OrdinaryCreateFromConstructor
/* global GetPrototypeFromConstructor */
// 9.1.13. OrdinaryCreateFromConstructor ( constructor, intrinsicDefaultProto [ , internalSlotsList ] )
function OrdinaryCreateFromConstructor(constructor, intrinsicDefaultProto) { // eslint-disable-line no-unused-vars
	var internalSlotsList = arguments[2] || {};
	// 1. Assert: intrinsicDefaultProto is a String value that is this specification's name of an intrinsic object.
	// The corresponding object must be an intrinsic that is intended to be used as the[[Prototype]] value of an object.

	// 2. Let proto be ? GetPrototypeFromConstructor(constructor, intrinsicDefaultProto).
	var proto = GetPrototypeFromConstructor(constructor, intrinsicDefaultProto);

	// 3. Return ObjectCreate(proto, internalSlotsList).
	// Polyfill.io - We do not pass internalSlotsList to Object.create because Object.create does not use the default ordinary object definitions specified in 9.1.
	var obj = Object.create(proto);
	for (var name in internalSlotsList) {
		if (Object.prototype.hasOwnProperty.call(internalSlotsList, name)) {
			Object.defineProperty(obj, name, {
				configurable: true,
				enumerable: false,
				writable: true,
				value: internalSlotsList[name]
			});
		}
	}
	return obj;
}

// _ESAbstract.IsConstructor
/* global Type */
// 7.2.4. IsConstructor ( argument )
function IsConstructor(argument) { // eslint-disable-line no-unused-vars
	// 1. If Type(argument) is not Object, return false.
	if (Type(argument) !== 'object') {
		return false;
	}
	// 2. If argument has a [[Construct]] internal method, return true.
	// 3. Return false.

	// Polyfill.io - `new argument` is the only way  to truly test if a function is a constructor.
	// We choose to not use`new argument` because the argument could have side effects when called.
	// Instead we check to see if the argument is a function and if it has a prototype.
	// Arrow functions do not have a [[Construct]] internal method, nor do they have a prototype.
	return typeof argument === 'function' && !!argument.prototype;
}

// _ESAbstract.Construct
/* global IsConstructor, OrdinaryCreateFromConstructor, Call */
// 7.3.13. Construct ( F [ , argumentsList [ , newTarget ]] )
function Construct(F /* [ , argumentsList [ , newTarget ]] */) { // eslint-disable-line no-unused-vars
	// 1. If newTarget is not present, set newTarget to F.
	var newTarget = arguments.length > 2 ? arguments[2] : F;

	// 2. If argumentsList is not present, set argumentsList to a new empty List.
	var argumentsList = arguments.length > 1 ? arguments[1] : [];

	// 3. Assert: IsConstructor(F) is true.
	if (!IsConstructor(F)) {
		throw new TypeError('F must be a constructor.');
	}

	// 4. Assert: IsConstructor(newTarget) is true.
	if (!IsConstructor(newTarget)) {
		throw new TypeError('newTarget must be a constructor.');
	}

	// 5. Return ? F.[[Construct]](argumentsList, newTarget).
	// Polyfill.io - If newTarget is the same as F, it is equivalent to new F(...argumentsList).
	if (newTarget === F) {
		return new (Function.prototype.bind.apply(F, [null].concat(argumentsList)))();
	} else {
		// Polyfill.io - This is mimicking section 9.2.2 step 5.a.
		var obj = OrdinaryCreateFromConstructor(newTarget, Object.prototype);
		return Call(F, obj, argumentsList);
	}
}

// _ESAbstract.IsRegExp
/* global Type, Get, ToBoolean */
// 7.2.8. IsRegExp ( argument )
function IsRegExp(argument) { // eslint-disable-line no-unused-vars
	// 1. If Type(argument) is not Object, return false.
	if (Type(argument) !== 'object') {
		return false;
	}
	// 2. Let matcher be ? Get(argument, @@match).
	var matcher = 'Symbol' in self && 'match' in self.Symbol ? Get(argument, self.Symbol.match) : undefined;
	// 3. If matcher is not undefined, return ToBoolean(matcher).
	if (matcher !== undefined) {
		return ToBoolean(matcher);
	}
	// 4. If argument has a [[RegExpMatcher]] internal slot, return true.
	try {
		var lastIndex = argument.lastIndex;
		argument.lastIndex = 0;
		RegExp.prototype.exec.call(argument);
		return true;
	// eslint-disable-next-line no-empty
	} catch (e) {} finally {
		argument.lastIndex = lastIndex;
	}
	// 5. Return false.
	return false;
}

// _ESAbstract.OrdinaryToPrimitive
/* global Get, IsCallable, Call, Type */
// 7.1.1.1. OrdinaryToPrimitive ( O, hint )
function OrdinaryToPrimitive(O, hint) { // eslint-disable-line no-unused-vars
	// 1. Assert: Type(O) is Object.
	// 2. Assert: Type(hint) is String and its value is either "string" or "number".
	// 3. If hint is "string", then
	if (hint === 'string') {
		// a. Let methodNames be « "toString", "valueOf" ».
		var methodNames = ['toString', 'valueOf'];
		// 4. Else,
	} else {
		// a. Let methodNames be « "valueOf", "toString" ».
		methodNames = ['valueOf', 'toString'];
	}
	// 5. For each name in methodNames in List order, do
	for (var i = 0; i < methodNames.length; ++i) {
		var name = methodNames[i];
		// a. Let method be ? Get(O, name).
		var method = Get(O, name);
		// b. If IsCallable(method) is true, then
		if (IsCallable(method)) {
			// i. Let result be ? Call(method, O).
			var result = Call(method, O);
			// ii. If Type(result) is not Object, return result.
			if (Type(result) !== 'object') {
				return result;
			}
		}
	}
	// 6. Throw a TypeError exception.
	throw new TypeError('Cannot convert to primitive.');
}

// _ESAbstract.SameValueZero
/* global Type, SameValueNonNumber */
// 7.2.11. SameValueZero ( x, y )
function SameValueZero (x, y) { // eslint-disable-line no-unused-vars
	// 1. If Type(x) is different from Type(y), return false.
	if (Type(x) !== Type(y)) {
		return false;
	}
	// 2. If Type(x) is Number, then
	if (Type(x) === 'number') {
		// a. If x is NaN and y is NaN, return true.
		if (isNaN(x) && isNaN(y)) {
			return true;
		}
		// b. If x is +0 and y is -0, return true.
		if (1/x === Infinity && 1/y === -Infinity) {
			return true;
		}
		// c. If x is -0 and y is +0, return true.
		if (1/x === -Infinity && 1/y === Infinity) {
			return true;
		}
		// d. If x is the same Number value as y, return true.
		if (x === y) {
			return true;
		}
		// e. Return false.
		return false;
	}
	// 3. Return SameValueNonNumber(x, y).
	return SameValueNonNumber(x, y);
}

// _ESAbstract.ToInteger
/* global Type */
// 7.1.4. ToInteger ( argument )
function ToInteger(argument) { // eslint-disable-line no-unused-vars
	if (Type(argument) === 'symbol') {
		throw new TypeError('Cannot convert a Symbol value to a number');
	}

	// 1. Let number be ? ToNumber(argument).
	var number = Number(argument);
	// 2. If number is NaN, return +0.
	if (isNaN(number)) {
		return 0;
	}
	// 3. If number is +0, -0, +∞, or -∞, return number.
	if (1/number === Infinity || 1/number === -Infinity || number === Infinity || number === -Infinity) {
		return number;
	}
	// 4. Return the number value that is the same sign as number and whose magnitude is floor(abs(number)).
	return ((number < 0) ? -1 : 1) * Math.floor(Math.abs(number));
}

// _ESAbstract.ToLength
/* global ToInteger */
// 7.1.15. ToLength ( argument )
function ToLength(argument) { // eslint-disable-line no-unused-vars
	// 1. Let len be ? ToInteger(argument).
	var len = ToInteger(argument);
	// 2. If len ≤ +0, return +0.
	if (len <= 0) {
		return 0;
	}
	// 3. Return min(len, 253-1).
	return Math.min(len, Math.pow(2, 53) -1);
}

// _ESAbstract.ToPrimitive
/* global Type, GetMethod, Call, OrdinaryToPrimitive */
// 7.1.1. ToPrimitive ( input [ , PreferredType ] )
function ToPrimitive(input /* [, PreferredType] */) { // eslint-disable-line no-unused-vars
	var PreferredType = arguments.length > 1 ? arguments[1] : undefined;
	// 1. Assert: input is an ECMAScript language value.
	// 2. If Type(input) is Object, then
	if (Type(input) === 'object') {
		// a. If PreferredType is not present, let hint be "default".
		if (arguments.length < 2) {
			var hint = 'default';
			// b. Else if PreferredType is hint String, let hint be "string".
		} else if (PreferredType === String) {
			hint = 'string';
			// c. Else PreferredType is hint Number, let hint be "number".
		} else if (PreferredType === Number) {
			hint = 'number';
		}
		// d. Let exoticToPrim be ? GetMethod(input, @@toPrimitive).
		var exoticToPrim = typeof self.Symbol === 'function' && typeof self.Symbol.toPrimitive === 'symbol' ? GetMethod(input, self.Symbol.toPrimitive) : undefined;
		// e. If exoticToPrim is not undefined, then
		if (exoticToPrim !== undefined) {
			// i. Let result be ? Call(exoticToPrim, input, « hint »).
			var result = Call(exoticToPrim, input, [hint]);
			// ii. If Type(result) is not Object, return result.
			if (Type(result) !== 'object') {
				return result;
			}
			// iii. Throw a TypeError exception.
			throw new TypeError('Cannot convert exotic object to primitive.');
		}
		// f. If hint is "default", set hint to "number".
		if (hint === 'default') {
			hint = 'number';
		}
		// g. Return ? OrdinaryToPrimitive(input, hint).
		return OrdinaryToPrimitive(input, hint);
	}
	// 3. Return input
	return input;
}

// _ESAbstract.ToPropertyDescriptor
/* globals Type, HasProperty, ToBoolean, Get, IsCallable */
// 6.2.5.5 ToPropertyDescriptor ( Obj )
function ToPropertyDescriptor(Obj) { // eslint-disable-line no-unused-vars
	// 1. If Type(Obj) is not Object, throw a TypeError exception.
	if (Type(Obj) !== 'object') {
		throw new TypeError('ToPropertyDescriptor requires an object and was given an ' + Object.prototype.toString.call(Obj));
	}
	// 2. Let desc be a new Property Descriptor that initially has no fields.
	var desc = {};
	// 3. Let hasEnumerable be ? HasProperty(Obj, "enumerable").
	var hasEnumerable = HasProperty(Obj, 'enumerable');
	// 4. If hasEnumerable is true, then
	if (hasEnumerable) {
		// a. Let enumerable be ToBoolean(? Get(Obj, "enumerable")).
		var enumerable = ToBoolean(Get(Obj, 'enumerable'));
		// b. Set desc.[[Enumerable]] to enumerable.
		desc['[[Enumerable]]'] = enumerable;
	}
	// 5. Let hasConfigurable be ? HasProperty(Obj, "configurable").
	var hasConfigurable = HasProperty(Obj, 'configurable');
	// 6. If hasConfigurable is true, then
	if (hasConfigurable) {
		// a. Let configurable be ToBoolean(? Get(Obj, "configurable")).
		var configurable = ToBoolean(Get(Obj, 'configurable'));
		// b. Set desc.[[Configurable]] to configurable.
		desc['[[Configurable]]'] = configurable;
	}
	// 7. Let hasValue be ? HasProperty(Obj, "value").
	var hasValue = HasProperty(Obj, 'value');
	// 8. If hasValue is true, then
	if (hasValue) {
		// a. Let value be ? Get(Obj, "value").
		var value = Get(Obj, "value");
		// b. Set desc.[[Value]] to value.
		desc['[[Value]]'] = value;
	}
	// 9. Let hasWritable be ? HasProperty(Obj, "writable").
	var hasWritable = HasProperty(Obj, 'writable');
	// 10. If hasWritable is true, then
	if (hasWritable) {
		// a. Let writable be ToBoolean(? Get(Obj, "writable")).
		var writable = ToBoolean(Get(Obj, "writable"));
		// b. Set desc.[[Writable]] to writable.
		desc['[[Writable]]'] = writable;
	}
	// 11. Let hasGet be ? HasProperty(Obj, "get").
	var hasGet = HasProperty(Obj, 'get');
	// 12. If hasGet is true, then
	if (hasGet) {
		// a. Let getter be ? Get(Obj, "get").
		var getter = Get(Obj, "get");
		// b. If IsCallable(getter) is false and getter is not undefined, throw a TypeError exception.
		if (IsCallable(getter) === false && getter !== undefined) {
			throw new TypeError('getter must be a function');
		}
		// c. Set desc.[[Get]] to getter.
		desc['[[Get]]'] = getter;
	}
	// 13. Let hasSet be ? HasProperty(Obj, "set").
	var hasSet = HasProperty(Obj, "set");
	// 14. If hasSet is true, then
	if (hasSet) {
		// a. Let setter be ? Get(Obj, "set").
		var setter = Get(Obj, "set");
		// b. If IsCallable(setter) is false and setter is not undefined, throw a TypeError exception.
		if (IsCallable(setter) === false && setter !== undefined) {
			throw new TypeError('setter must be a function');
		}
		// c. Set desc.[[Set]] to setter.
		desc['[[Set]]'] = setter;
	}
	// 15. If desc.[[Get]] is present or desc.[[Set]] is present, then
	if ((HasProperty(desc, '[[Get]]') || HasProperty(desc, '[[Set]]'))) {
		// a. If desc.[[Value]] is present or desc.[[Writable]] is present, throw a TypeError exception.
		if (HasProperty(desc, '[[Value]]') || HasProperty(desc, '[[Writable]]')) {
			throw new TypeError('Invalid property descriptor. Cannot both specify accessors and a value or writable attribute');
		}
	}
	// 16. Return desc.
	return desc;
}

// _ESAbstract.ToString
/* global Type, ToPrimitive */
// 7.1.12. ToString ( argument )
// The abstract operation ToString converts argument to a value of type String according to Table 11:
// Table 11: ToString Conversions
/*
|---------------|--------------------------------------------------------|
| Argument Type | Result                                                 |
|---------------|--------------------------------------------------------|
| Undefined     | Return "undefined".                                    |
|---------------|--------------------------------------------------------|
| Null	        | Return "null".                                         |
|---------------|--------------------------------------------------------|
| Boolean       | If argument is true, return "true".                    |
|               | If argument is false, return "false".                  |
|---------------|--------------------------------------------------------|
| Number        | Return NumberToString(argument).                       |
|---------------|--------------------------------------------------------|
| String        | Return argument.                                       |
|---------------|--------------------------------------------------------|
| Symbol        | Throw a TypeError exception.                           |
|---------------|--------------------------------------------------------|
| Object        | Apply the following steps:                             |
|               | Let primValue be ? ToPrimitive(argument, hint String). |
|               | Return ? ToString(primValue).                          |
|---------------|--------------------------------------------------------|
*/
function ToString(argument) { // eslint-disable-line no-unused-vars
	switch(Type(argument)) {
		case 'symbol':
			throw new TypeError('Cannot convert a Symbol value to a string');
		case 'object':
			var primValue = ToPrimitive(argument, String);
			return ToString(primValue); // eslint-disable-line no-unused-vars
		default:
			return String(argument);
	}
}

// _ESAbstract.ToPropertyKey
/* globals ToPrimitive, Type, ToString */
// 7.1.14. ToPropertyKey ( argument )
function ToPropertyKey(argument) { // eslint-disable-line no-unused-vars
	// 1. Let key be ? ToPrimitive(argument, hint String).
	var key = ToPrimitive(argument, String);
	// 2. If Type(key) is Symbol, then
	if (Type(key) === 'symbol') {
		// a. Return key.
		return key;
	}
	// 3. Return ! ToString(key).
	return ToString(key);
}

// _mutation
var _mutation = (function () { // eslint-disable-line no-unused-vars

	function isNode(object) {
		// DOM, Level2
		if (typeof Node === 'function') {
			return object instanceof Node;
		}
		// Older browsers, check if it looks like a Node instance)
		return object &&
			typeof object === "object" &&
			object.nodeName &&
			object.nodeType >= 1 &&
			object.nodeType <= 12;
	}

	// http://dom.spec.whatwg.org/#mutation-method-macro
	return function mutation(nodes) {
		if (nodes.length === 1) {
			return isNode(nodes[0]) ? nodes[0] : document.createTextNode(nodes[0] + '');
		}

		var fragment = document.createDocumentFragment();
		for (var i = 0; i < nodes.length; i++) {
			fragment.appendChild(isNode(nodes[i]) ? nodes[i] : document.createTextNode(nodes[i] + ''));

		}
		return fragment;
	};
}());

// Array.prototype.includes
/* global CreateMethodProperty, Get, SameValueZero, ToInteger, ToLength, ToObject, ToString */
// 22.1.3.11. Array.prototype.includes ( searchElement [ , fromIndex ] )
CreateMethodProperty(Array.prototype, 'includes', function includes(searchElement /* [ , fromIndex ] */) {
	'use strict';
	// 1. Let O be ? ToObject(this value).
	var O = ToObject(this);
	// 2. Let len be ? ToLength(? Get(O, "length")).
	var len = ToLength(Get(O, "length"));
	// 3. If len is 0, return false.
	if (len === 0) {
		return false;
	}
	// 4. Let n be ? ToInteger(fromIndex). (If fromIndex is undefined, this step produces the value 0.)
	var n = ToInteger(arguments[1]);
	// 5. If n ≥ 0, then
	if (n >= 0) {
		// a. Let k be n.
		var k = n;
		// 6. Else n < 0,
	} else {
		// a. Let k be len + n.
		k = len + n;
		// b. If k < 0, let k be 0.
		if (k < 0) {
			k = 0;
		}
	}
	// 7. Repeat, while k < len
	while (k < len) {
		// a. Let elementK be the result of ? Get(O, ! ToString(k)).
		var elementK = Get(O, ToString(k));
		// b. If SameValueZero(searchElement, elementK) is true, return true.
		if (SameValueZero(searchElement, elementK)) {
			return true;
		}
		// c. Increase k by 1.
		k = k + 1;
	}
	// 8. Return false.
	return false;
});

// _ESAbstract.CreateListFromArrayLike
/* global Type, ToLength, Get, ToString */
// 7.3.17 CreateListFromArrayLike ( obj [ , elementTypes ] )
function CreateListFromArrayLike(obj /*[ , elementTypes ]*/) { // eslint-disable-line no-unused-vars
	// 1. If elementTypes is not present, set elementTypes to « Undefined, Null, Boolean, String, Symbol, Number, Object ».
	var elementTypes = 1 in arguments ? arguments[1] : ['undefined', 'null', 'boolean', 'string', 'symbol', 'number', 'object'];
	// 2. If Type(obj) is not Object, throw a TypeError exception.
	if (Type(obj) !== 'object') {
		throw new TypeError(Object.prototype.toString.call(obj) + ' is not an Object');
	}
	// 3. Let len be ? ToLength(? Get(obj, "length")).
	var len = ToLength(Get(obj, 'length'));
	// 4. Let list be a new empty List.
	var list = [];
	// 5. Let index be 0.
	var index = 0;
	// 6. Repeat, while index < len
	while (index < len) {
		// a. Let indexName be ! ToString(index).
		var indexName = ToString(index);
		// b. Let next be ? Get(obj, indexName).
		var next = Get(obj, indexName);
		// c. If Type(next) is not an element of elementTypes, throw a TypeError exception.
		if (!elementTypes.includes(Type(next))) {
			throw new TypeError(Object.prototype.toString.call(next) + ' is not one of the required types: ' + Array.prototype.join.call(elementTypes, ','));
		}
		// d. Append next as the last element of list.
		list.push(next);
		// e. Increase index by 1.
		index = index + 1;
	}
	// 7. Return list.
	return list;
}

// DocumentFragment
(function (global) {
	global.DocumentFragment = function DocumentFragment() {
		return document.createDocumentFragment();
	};

	var fragment = document.createDocumentFragment();
	global.DocumentFragment.prototype = Object.create(fragment.constructor.prototype)
}(self));

// DocumentFragment.prototype.append
/* global _mutation */
(function (global) {
	var fragmentProto = document.createDocumentFragment().constructor.prototype;
	fragmentProto.append = function append() {
		this.appendChild(_mutation(arguments));
	};

	global.DocumentFragment.prototype.append = function append() {
		this.appendChild(_mutation(arguments));
	};
}(self));

// Element.prototype.append
/* global _mutation */
Document.prototype.append = Element.prototype.append = function append() {
	this.appendChild(_mutation(arguments));
};

// Math.hypot
/* global CreateMethodProperty */
// 20.2.2.18. Math.hypot ( value1, value2, ...values )
CreateMethodProperty(Math, 'hypot', function hypot(value1, value2) { // eslint-disable-line no-unused-vars
	// If no arguments are passed, the result is +0.
	if (arguments.length === 0) {
		return 0;
	}
	var y = 0;
	var max = 0;
	for (var i = 0; i < arguments.length; ++i) {
		// If any argument is +∞, the result is +∞.
		if (arguments[i] === Infinity) {
			return Infinity;
		}

		// If any argument is -∞, the result is +∞.
		if (arguments[i] === -Infinity) {
			return Infinity;
		}

		// If no argument is +∞ or -∞, and any argument is NaN, the result is NaN.
		// If all arguments are either +0 or -0, the result is +0.
		// Polyfill.io - The two conditions above are handled in the math.

		var arg = Math.abs(Number(arguments[i]));
		if (arg > max) {
			y = y * Math.pow(max / arg, 2);
			max = arg;
		}
		if (arg !== 0 || max !== 0) {
			y = y + Math.pow(arg / max, 2);
		}
	}

	return max * Math.sqrt(y);
});

// Object.getOwnPropertyDescriptor
/* global CreateMethodProperty, ToObject, ToPropertyKey, HasOwnProperty, Type */
(function () {
	var nativeGetOwnPropertyDescriptor = Object.getOwnPropertyDescriptor;

	var supportsDOMDescriptors = (function () {
		try {
			return Object.defineProperty(document.createElement('div'), 'one', {
				get: function () {
					return 1;
				}
			}).one === 1;
		} catch (e) {
			return false;
		}
	});

	var toString = ({}).toString;
	var split = ''.split;

	// 19.1.2.8 Object.getOwnPropertyDescriptor ( O, P )
	CreateMethodProperty(Object, 'getOwnPropertyDescriptor', function getOwnPropertyDescriptor(O, P) {
		// 1. Let obj be ? ToObject(O).
		var obj = ToObject(O);
		// Polyfill.io fallback for non-array-like strings which exist in some ES3 user-agents (IE 8)
		obj = (Type(obj) === 'string' || obj instanceof String) && toString.call(O) == '[object String]' ? split.call(O, '') : Object(O);

		// 2. Let key be ? ToPropertyKey(P).
		var key = ToPropertyKey(P);

		// 3. Let desc be ? obj.[[GetOwnProperty]](key).
		// 4. Return FromPropertyDescriptor(desc).
		// Polyfill.io Internet Explorer 8 natively supports property descriptors only on DOM objects.
		// We will fallback to the polyfill implementation if the native implementation throws an error.
		if (supportsDOMDescriptors) {
			try {
				return nativeGetOwnPropertyDescriptor(obj, key);
			// eslint-disable-next-line no-empty
			} catch (error) {}
		}
		if (HasOwnProperty(obj, key)) {
			return {
				enumerable: true,
				configurable: true,
				writable: true,
				value: obj[key]
			};
		}
	});
}());

// Object.isExtensible
/* global CreateMethodProperty, Type */

(function (nativeIsExtensible) {
	// 19.1.2.13 Object.isExtensible ( O )
	CreateMethodProperty(Object, 'isExtensible', function isExtensible(O) {
		// 1. If Type(O) is not Object, return false.
		if (Type(O) !== "object") {
			return false;
		}
		// 2. Return ? IsExtensible(O).
		return nativeIsExtensible ? nativeIsExtensible(O) : true;
	});
}(Object.isExtensible));

// Object.keys
/* global CreateMethodProperty */
CreateMethodProperty(Object, "keys", (function() {
	'use strict';

	// modified from https://github.com/es-shims/object-keys

	var has = Object.prototype.hasOwnProperty;
	var toStr = Object.prototype.toString;
	var isEnumerable = Object.prototype.propertyIsEnumerable;
	var hasDontEnumBug = !isEnumerable.call({ toString: null }, 'toString');
	var hasPrototypeEnumBug = isEnumerable.call(function () { }, 'prototype');
	function hasProtoEnumBug() {
		// Object.create polyfill creates an enumerable __proto__
		var createdObj;
		try {
			createdObj = Object.create({});
		} catch (e) {
			// If this fails the polyfil isn't loaded yet, but will be.
			// Can't add it to depedencies because of it would create a circular depedency.
			return true;
		}

		return isEnumerable.call(createdObj, '__proto__')
	}

	var dontEnums = [
		'toString',
		'toLocaleString',
		'valueOf',
		'hasOwnProperty',
		'isPrototypeOf',
		'propertyIsEnumerable',
		'constructor'
	];
	var equalsConstructorPrototype = function (o) {
		var ctor = o.constructor;
		return ctor && ctor.prototype === o;
	};
	var excludedKeys = {
		$console: true,
		$external: true,
		$frame: true,
		$frameElement: true,
		$frames: true,
		$innerHeight: true,
		$innerWidth: true,
		$outerHeight: true,
		$outerWidth: true,
		$pageXOffset: true,
		$pageYOffset: true,
		$parent: true,
		$scrollLeft: true,
		$scrollTop: true,
		$scrollX: true,
		$scrollY: true,
		$self: true,
		$webkitIndexedDB: true,
		$webkitStorageInfo: true,
		$window: true
	};
	var hasAutomationEqualityBug = (function () {
		if (typeof window === 'undefined') { return false; }
		for (var k in window) {
			try {
				if (!excludedKeys['$' + k] && has.call(window, k) && window[k] !== null && typeof window[k] === 'object') {
					try {
						equalsConstructorPrototype(window[k]);
					} catch (e) {
						return true;
					}
				}
			} catch (e) {
				return true;
			}
		}
		return false;
	}());
	var equalsConstructorPrototypeIfNotBuggy = function (o) {
		if (typeof window === 'undefined' || !hasAutomationEqualityBug) {
			return equalsConstructorPrototype(o);
		}
		try {
			return equalsConstructorPrototype(o);
		} catch (e) {
			return false;
		}
	};

	function isArgumentsObject(value) {
		var str = toStr.call(value);
		var isArgs = str === '[object Arguments]';
		if (!isArgs) {
			isArgs = str !== '[object Array]' &&
				value !== null &&
				typeof value === 'object' &&
				typeof value.length === 'number' &&
				value.length >= 0 &&
				toStr.call(value.callee) === '[object Function]';
		}
		return isArgs;
	}

	return function keys(object) {
		var isFunction = toStr.call(object) === '[object Function]';
		var isArguments = isArgumentsObject(object);
		var isString = toStr.call(object) === '[object String]';
		var theKeys = [];

		if (object === undefined || object === null) {
			throw new TypeError('Cannot convert undefined or null to object');
		}

		var skipPrototype = hasPrototypeEnumBug && isFunction;
		if (isString && object.length > 0 && !has.call(object, 0)) {
			for (var i = 0; i < object.length; ++i) {
				theKeys.push(String(i));
			}
		}

		if (isArguments && object.length > 0) {
			for (var j = 0; j < object.length; ++j) {
				theKeys.push(String(j));
			}
		} else {
			for (var name in object) {
				if (!(hasProtoEnumBug() && name === '__proto__') && !(skipPrototype && name === 'prototype') && has.call(object, name)) {
					theKeys.push(String(name));
				}
			}
		}

		if (hasDontEnumBug) {
			var skipConstructor = equalsConstructorPrototypeIfNotBuggy(object);

			for (var k = 0; k < dontEnums.length; ++k) {
				if (!(skipConstructor && dontEnums[k] === 'constructor') && has.call(object, dontEnums[k])) {
					theKeys.push(dontEnums[k]);
				}
			}
		}
		return theKeys;
	};
}()));

// Object.assign
/* global CreateMethodProperty, Get, ToObject */
// 19.1.2.1 Object.assign ( target, ...sources )
CreateMethodProperty(Object, 'assign', function assign(target, source) { // eslint-disable-line no-unused-vars
	// 1. Let to be ? ToObject(target).
	var to = ToObject(target);

	// 2. If only one argument was passed, return to.
	if (arguments.length === 1) {
		return to;
	}

	// 3. Let sources be the List of argument values starting with the second argument
	var sources = Array.prototype.slice.call(arguments, 1);

	// 4. For each element nextSource of sources, in ascending index order, do
	var index1;
	var index2;
	var keys;
	var from;
	for (index1 = 0; index1 < sources.length; index1++) {
		var nextSource = sources[index1];
		// a. If nextSource is undefined or null, let keys be a new empty List.
		if (nextSource === undefined || nextSource === null) {
			keys = [];
			// b. Else,
		} else {
			// Polyfill.io - In order to get strings in ES3 and old V8 working correctly we need to split them into an array ourselves.
			// i. Let from be ! ToObject(nextSource).
			from = Object.prototype.toString.call(nextSource) === '[object String]' ? String(nextSource).split('') : ToObject(nextSource);
			// ii. Let keys be ? from.[[OwnPropertyKeys]]().
			/*
				This step in our polyfill is not complying with the specification.
				[[OwnPropertyKeys]] is meant to return ALL keys, including non-enumerable and symbols.
				TODO: When we have Reflect.ownKeys, use that instead as it is the userland equivalent of [[OwnPropertyKeys]].
			*/
			keys = Object.keys(from);
		}

		// c. For each element nextKey of keys in List order, do
		for (index2 = 0; index2 < keys.length; index2++) {
			var nextKey = keys[index2];
			var enumerable;
			try {
				// i. Let desc be ? from.[[GetOwnProperty]](nextKey).
				var desc = Object.getOwnPropertyDescriptor(from, nextKey);
				// ii. If desc is not undefined and desc.[[Enumerable]] is true, then
				enumerable = desc !== undefined && desc.enumerable === true;
			} catch (e) {
				// Polyfill.io - We use Object.prototype.propertyIsEnumerable as a fallback
				// because `Object.getOwnPropertyDescriptor(window.location, 'hash')` causes Internet Explorer 11 to crash.
				enumerable = Object.prototype.propertyIsEnumerable.call(from, nextKey);
			}
			if (enumerable) {
				// 1. Let propValue be ? Get(from, nextKey).
				var propValue = Get(from, nextKey);
				// 2. Perform ? Set(to, nextKey, propValue, true).
				to[nextKey] = propValue;
			}
		}
	}
	// 5. Return to.
	return to;
});

// Object.getOwnPropertyNames
/* global CreateMethodProperty, ToObject */
(function() {
	var toString = {}.toString;
	var split = "".split;
	var concat = [].concat;
	var hasOwnProperty = Object.prototype.hasOwnProperty;
	var nativeGetOwnPropertyNames = Object.getOwnPropertyNames || Object.keys;
	var cachedWindowNames =
		typeof self === "object" ? nativeGetOwnPropertyNames(self) : [];

	// 19.1.2.10 Object.getOwnPropertyNames ( O )
	CreateMethodProperty(
		Object,
		"getOwnPropertyNames",
		function getOwnPropertyNames(O) {
			var object = ToObject(O);

			if (toString.call(object) === "[object Window]") {
				try {
					return nativeGetOwnPropertyNames(object);
				} catch (e) {
					// IE bug where layout engine calls userland Object.getOwnPropertyNames for cross-domain `window` objects
					return concat.call([], cachedWindowNames);
				}
			}

			// Polyfill.io fallback for non-array-like strings which exist in some ES3 user-agents (IE 8)
			object =
				toString.call(object) == "[object String]"
					? split.call(object, "")
					: Object(object);

			var result = nativeGetOwnPropertyNames(object);
			var extraNonEnumerableKeys = ["length", "prototype"];
			for (var i = 0; i < extraNonEnumerableKeys.length; i++) {
				var key = extraNonEnumerableKeys[i];
				if (hasOwnProperty.call(object, key) && !result.includes(key)) {
					result.push(key);
				}
			}

			if (result.includes("__proto__")) {
				var index = result.indexOf("__proto__");
				result.splice(index, 1);
			}

			return result;
		}
	);
})();

// Object.setPrototypeOf
/* global CreateMethodProperty */
// ES6-shim 0.16.0 (c) 2013-2014 Paul Miller (http://paulmillr.com)
// ES6-shim may be freely distributed under the MIT license.
// For more details and documentation:
// https://github.com/paulmillr/es6-shim/

 // NOTE:  This versions needs object ownership
  //        because every promoted object needs to be reassigned
  //        otherwise uncompatible browsers cannot work as expected
  //
  // NOTE:  This might need es5-shim or polyfills upfront
  //        because it's based on ES5 API.
  //        (probably just an IE <= 8 problem)
  //
  // NOTE:  nodejs is fine in version 0.8, 0.10, and future versions.
(function () {
	if (Object.setPrototypeOf) { return; }

	/*jshint proto: true */
	// @author    Andrea Giammarchi - @WebReflection

	var getOwnPropertyNames = Object.getOwnPropertyNames;
	var getOwnPropertyDescriptor = Object.getOwnPropertyDescriptor;
	var create = Object.create;
	var defineProperty = Object.defineProperty;
	var getPrototypeOf = Object.getPrototypeOf;
	var objProto = Object.prototype;

	var copyDescriptors = function (target, source) {
		// define into target descriptors from source
		getOwnPropertyNames(source).forEach(function (key) {
			defineProperty(
				target,
				key,
				getOwnPropertyDescriptor(source, key)
			);
		});
		return target;
	};
	// used as fallback when no promotion is possible
	var createAndCopy = function setPrototypeOf(origin, proto) {
		return copyDescriptors(create(proto), origin);
	};
	var set, sPOf;
	try {
		// this might fail for various reasons
		// ignore if Chrome cought it at runtime
		set = getOwnPropertyDescriptor(objProto, '__proto__').set;
		set.call({}, null);
		// setter not poisoned, it can promote
		// Firefox, Chrome
		sPOf = function setPrototypeOf(origin, proto) {
			set.call(origin, proto);
			return origin;
		};
	} catch (e) {
		// do one or more feature detections
		set = { __proto__: null };
		// if proto does not work, needs to fallback
		// some Opera, Rhino, ducktape
		if (set instanceof Object) {
			sPOf = createAndCopy;
		} else {
			// verify if null objects are buggy
			/* eslint-disable no-proto */
			set.__proto__ = objProto;
			/* eslint-enable no-proto */
			// if null objects are buggy
			// nodejs 0.8 to 0.10
			if (set instanceof Object) {
				sPOf = function setPrototypeOf(origin, proto) {
					// use such bug to promote
					/* eslint-disable no-proto */
					origin.__proto__ = proto;
					/* eslint-enable no-proto */
					return origin;
				};
			} else {
				// try to use proto or fallback
				// Safari, old Firefox, many others
				sPOf = function setPrototypeOf(origin, proto) {
					// if proto is not null
					if (getPrototypeOf(origin)) {
						// use __proto__ to promote
						/* eslint-disable no-proto */
						origin.__proto__ = proto;
						/* eslint-enable no-proto */
						return origin;
					} else {
						// otherwise unable to promote: fallback
						return createAndCopy(origin, proto);
					}
				};
			}
		}
	}
	CreateMethodProperty(Object, 'setPrototypeOf', sPOf);
}());

// Reflect
// 26.1 The Reflect Object
try {
	Object.defineProperty(self, "Reflect", {
		value: self.Reflect || {},
		writable: true,
		configurable: true,
		enumerable: false
	});
} catch (e) {
	self.Reflect = self.Reflect || {};
}

// Reflect.apply
/* global CreateMethodProperty, IsCallable, CreateListFromArrayLike, Call, Reflect*/
// 26.1.1 Reflect.apply ( target, thisArgument, argumentsList )
CreateMethodProperty(Reflect, 'apply', function apply(target, thisArgument, argumentsList ) {
	// 1. If IsCallable(target) is false, throw a TypeError exception.
	if (IsCallable(target) === false) {
		throw new TypeError('Reflect.apply was called on ' + Object.prototype.toString.call(target) + ', which is not a function');
	}
	// 2. Let args be ? CreateListFromArrayLike(argumentsList).
	var args = CreateListFromArrayLike(argumentsList);
	// Polyfill-library -- This is not required for us to implement because we do not control the execution stack.
	// 3. Perform PrepareForTailCall().

	// 4. Return ? Call(target, thisArgument, args).
	return Call(target, thisArgument, args);
});

// Reflect.construct
/* global CreateMethodProperty, Reflect, IsConstructor, CreateListFromArrayLike, Construct */
// 26.1.2 Reflect.construct ( target, argumentsList [ , newTarget ] )
CreateMethodProperty(Reflect, 'construct', function construct(target, argumentsList /*[ , newTarget ]*/) {
	var newTarget = arguments[2];
	// 1. If IsConstructor(target) is false, throw a TypeError exception.
	if(IsConstructor(target) === false) {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not a constructor');
	}
	// 2. If newTarget is not present, set newTarget to target.
	if (!(2 in arguments)){
		newTarget = target;
		// 3. Else if IsConstructor(newTarget) is false, throw a TypeError exception.
	} else if (IsConstructor(newTarget) === false) {
		throw new TypeError(Object.prototype.toString.call(newTarget) + ' is not a constructor');
	}
	// 4. Let args be ? CreateListFromArrayLike(argumentsList).
	var args = CreateListFromArrayLike(argumentsList);
	// 5. Return ? Construct(target, args, newTarget).
	return Construct(target, args, newTarget);
});

// Reflect.defineProperty
/* global CreateMethodProperty, Reflect, Type, ToPropertyKey, ToPropertyDescriptor */
// 26.1.3 Reflect.defineProperty ( target, propertyKey, attributes )
CreateMethodProperty(Reflect, 'defineProperty', function defineProperty(target, propertyKey, attributes ) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Let key be ? ToPropertyKey(propertyKey).
	var key = ToPropertyKey(propertyKey);
	// 3. Let desc be ? ToPropertyDescriptor(attributes).
	var desc = ToPropertyDescriptor(attributes);
	// 4. Return ? target.[[DefineOwnProperty]](key, desc).
	try {
		Object.defineProperty(target, key, desc);
		return true;
	} catch (e) {
		return false;
	}
});

// Reflect.deleteProperty
/* global Reflect, CreateMethodProperty, Type, ToPropertyKey, HasOwnProperty */
// 26.1.4 Reflect.deleteProperty ( target, propertyKey )
CreateMethodProperty(Reflect, 'deleteProperty', function deleteProperty(target, propertyKey) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Let key be ? ToPropertyKey(propertyKey).
	var key = ToPropertyKey(propertyKey);
	// 3. Return ? target.[[Delete]](key).
	try {
		delete target[key];
		return !HasOwnProperty(target, key);
	} catch (_) {
		return false;
	}
});

// Reflect.get
/* global Reflect, Call, CreateMethodProperty, Type, ToPropertyKey */
(function () {
	function _get(target, key, receiver) {
		var desc = Object.getOwnPropertyDescriptor(target, key);

		if (!desc) {
			var parent = Object.getPrototypeOf(target);

			if (parent === null) {
				return undefined;
			}

			return _get(parent, key, receiver);
		}

		if ('value' in desc) {
			return desc.value;
		}

		if (desc.get) {
			return Call(desc.get, receiver);
		}

		return undefined;
	}
	// 26.1.5 Reflect.get ( target, propertyKey [ , receiver ] )
	CreateMethodProperty(Reflect, 'get', function get(target, propertyKey /*[ , receiver ]*/ ) {
		var receiver = arguments[2];
		// 1. If Type(target) is not Object, throw a TypeError exception.
		if (Type(target) !== "object") {
			throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
		}
		// 2. Let key be ? ToPropertyKey(propertyKey).
		var key = ToPropertyKey(propertyKey);
		// 3. If receiver is not present, then
		if (!(2 in arguments)) {
			// a. Set receiver to target.
			receiver = target;
		}
		// 4. Return ? target.[[Get]](key, receiver).
		return _get(target, key, receiver);
	});
}());

// Reflect.getOwnPropertyDescriptor
/* global CreateMethodProperty, Reflect, Type, ToPropertyKey */
// 26.1.6 Reflect.getOwnPropertyDescriptor ( target, propertyKey )
CreateMethodProperty(Reflect, 'getOwnPropertyDescriptor', function getOwnPropertyDescriptor(target, propertyKey) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Let key be ? ToPropertyKey(propertyKey).
	var key = ToPropertyKey(propertyKey);
	// Polyfill-library - these steps are handled by Object.getOwnPropertyDescriptor
	// 3. Let desc be ? target.[[GetOwnProperty]](key).
	// 4. Return FromPropertyDescriptor(desc).
	return Object.getOwnPropertyDescriptor(target, key);
});

// Reflect.getPrototypeOf
/* global CreateMethodProperty, Reflect, Type */
// 26.1.7 Reflect.getPrototypeOf ( target )
CreateMethodProperty(Reflect, 'getPrototypeOf', function getPrototypeOf(target) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Return ? target.[[GetPrototypeOf]]().
	return Object.getPrototypeOf(target);
});

// Reflect.has
/* global CreateMethodProperty, Reflect, Type, ToPropertyKey, HasProperty */
// 26.1.8 Reflect.has ( target, propertyKey )
CreateMethodProperty(Reflect, 'has', function has(target, propertyKey) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Let key be ? ToPropertyKey(propertyKey).
	var key = ToPropertyKey(propertyKey);
	// 3. Return ? target.[[HasProperty]](key).
	return HasProperty(target, key);
});

// Reflect.isExtensible
/* global CreateMethodProperty, Reflect, Type */
// 26.1.9 Reflect.isExtensible ( target )
CreateMethodProperty(Reflect, 'isExtensible', function isExtensible(target) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. Return ? target.[[IsExtensible]]().
	return Object.isExtensible(target);
});

// Reflect.preventExtensions
/* global CreateMethodProperty, Reflect, Type */
// 26.1.11 Reflect.preventExtensions ( target )
CreateMethodProperty(Reflect, 'preventExtensions', function preventExtensions(target) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}

	// 2. Return ? target.[[PreventExtensions]]().
	try {
		Object.preventExtensions(target);
		return true;
	} catch (_) {
		return false;
	}
});

// Reflect.set
/* global CreateMethodProperty, Reflect, Type, ToPropertyKey, Call */
(function () {
	function _set(propertyKey, value, receiver, target) {
		var desc = Object.getOwnPropertyDescriptor(target, propertyKey);
		try {
			if (desc && desc.set) {
				return Call(desc.set, receiver, [value]);
			} else {
				target[propertyKey] = value;
			}
			return true;
		} catch (e) {
			return false;
		}
	}
	// 26.1.12 Reflect.set ( target, propertyKey, V [ , receiver ] )
	CreateMethodProperty(Reflect, 'set', function set(target, propertyKey, V /*[ , receiver ]*/ ) {
		var receiver = arguments[3];
		// 1. If Type(target) is not Object, throw a TypeError exception.
		if (Type(target) !== "object") {
			throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
		}
		// 2. Let key be ? ToPropertyKey(propertyKey).
		var key = ToPropertyKey(propertyKey);
		// 3. If receiver is not present, then
		if (!(3 in arguments)) {
			// a. Set receiver to target.
			receiver = target;
		}
		// 4. Return ? target.[[Set]](key, V, receiver).
		return _set(key, V, receiver, target);
	});
}());

// Reflect.setPrototypeOf
/* global CreateMethodProperty, Reflect, Type, */
// 26.1.13 Reflect.setPrototypeOf ( target, proto )
CreateMethodProperty(Reflect, 'setPrototypeOf', function setPrototypeOf(target, proto) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// 2. If Type(proto) is not Object and proto is not null, throw a TypeError exception.
	if (Type(proto) !== "object" && proto !== null) {
		throw new TypeError(Object.prototype.toString.call(proto) + ' is not an Object or null');
	}

	if (target === proto) {
		return false;
	}
	// 3. Return ? target.[[SetPrototypeOf]](proto).
	try {
		Object.setPrototypeOf(target, proto);
		return Reflect.getPrototypeOf(target) === proto;
	} catch(_) {
		return false;
	}
});

// String.prototype.includes
/* global CreateMethodProperty, IsRegExp, RequireObjectCoercible, ToInteger, ToString */
// 21.1.3.7. String.prototype.includes ( searchString [ , position ] )
CreateMethodProperty(String.prototype, 'includes', function includes(searchString /* [ , position ] */) {
	'use strict';
	var position = arguments.length > 1 ? arguments[1] : undefined;
	// 1. Let O be ? RequireObjectCoercible(this value).
	var O = RequireObjectCoercible(this);
	// 2. Let S be ? ToString(O).
	var S = ToString(O);
	// 3. Let isRegExp be ? IsRegExp(searchString).
	var isRegExp = IsRegExp(searchString);
	// 4. If isRegExp is true, throw a TypeError exception.
	if (isRegExp) {
		throw new TypeError('First argument to String.prototype.includes must not be a regular expression');
	}
	// 5. Let searchStr be ? ToString(searchString).
	var searchStr = ToString(searchString);
	// 6. Let pos be ? ToInteger(position). (If position is undefined, this step produces the value 0.)
	var pos = ToInteger(position);
	// 7. Let len be the length of S.
	var len = S.length;
	// 8. Let start be min(max(pos, 0), len).
	var start = Math.min(Math.max(pos, 0), len);
	// 9. Let searchLen be the length of searchStr.
	// var searchLength = searchStr.length;
	// 10. If there exists any integer k not smaller than start such that k + searchLen is not greater than len, and for all nonnegative integers j less than searchLen, the code unit at index k+j within S is the same as the code unit at index j within searchStr, return true; but if there is no such integer k, return false.
	return String.prototype.indexOf.call(S, searchStr, start) !== -1;
});

// Symbol
// A modification of https://github.com/WebReflection/get-own-property-symbols
// (C) Andrea Giammarchi - MIT Licensed

/* global Type */
(function (Object,  GOPS, global) {
	'use strict'; //so that ({}).toString.call(null) returns the correct [object Null] rather than [object Window]

	var supportsGetters = (function () {
		// supports getters
		try {
			var a = {};
			Object.defineProperty(a, "t", {
				configurable: true,
				enumerable: false,
				get: function () {
					return true;
				},
				set: undefined
			});
			return !!a.t;
		} catch (e) {
			return false;
		}
	}());

	var	setDescriptor;
	var id = 0;
	var random = '' + Math.random();
	var prefix = '__\x01symbol:';
	var prefixLength = prefix.length;
	var internalSymbol = '__\x01symbol@@' + random;
	var emptySymbolLookup = {};
	var DP = 'defineProperty';
	var DPies = 'defineProperties';
	var GOPN = 'getOwnPropertyNames';
	var GOPD = 'getOwnPropertyDescriptor';
	var PIE = 'propertyIsEnumerable';
	var ObjectProto = Object.prototype;
	var hOP = ObjectProto.hasOwnProperty;
	var pIE = ObjectProto[PIE];
	var toString = ObjectProto.toString;
	var concat = Array.prototype.concat;
	var cachedWindowNames = Object.getOwnPropertyNames ? Object.getOwnPropertyNames(self) : [];
	var nGOPN = Object[GOPN];
	var gOPN = function getOwnPropertyNames (obj) {
		if (toString.call(obj) === '[object Window]') {
			try {
				return nGOPN(obj);
			} catch (e) {
				// IE bug where layout engine calls userland gOPN for cross-domain `window` objects
				return concat.call([], cachedWindowNames);
			}
		}
		return nGOPN(obj);
	};
	var gOPD = Object[GOPD];
	var objectCreate = Object.create;
	var objectKeys = Object.keys;
	var freeze = Object.freeze || Object;
	var objectDefineProperty = Object[DP];
	var $defineProperties = Object[DPies];
	var descriptor = gOPD(Object, GOPN);
	var addInternalIfNeeded = function (o, uid, enumerable) {
		if (!hOP.call(o, internalSymbol)) {
			try {
				objectDefineProperty(o, internalSymbol, {
					enumerable: false,
					configurable: false,
					writable: false,
					value: {}
				});
			} catch (e) {
				o[internalSymbol] = {};
			}
		}
		o[internalSymbol]['@@' + uid] = enumerable;
	};
	var createWithSymbols = function (proto, descriptors) {
		var self = objectCreate(proto);
		gOPN(descriptors).forEach(function (key) {
			if (propertyIsEnumerable.call(descriptors, key)) {
				$defineProperty(self, key, descriptors[key]);
			}
		});
		return self;
	};
	var copyAsNonEnumerable = function (descriptor) {
		var newDescriptor = objectCreate(descriptor);
		newDescriptor.enumerable = false;
		return newDescriptor;
	};
	var get = function get(){};
	var onlyNonSymbols = function (name) {
		return name != internalSymbol &&
			!hOP.call(source, name);
	};
	var onlySymbols = function (name) {
		return name != internalSymbol &&
			hOP.call(source, name);
	};
	var propertyIsEnumerable = function propertyIsEnumerable(key) {
		var uid = '' + key;
		return onlySymbols(uid) ? (
			hOP.call(this, uid) &&
			this[internalSymbol] && this[internalSymbol]['@@' + uid]
		) : pIE.call(this, key);
	};
	var setAndGetSymbol = function (uid) {
		var descriptor = {
			enumerable: false,
			configurable: true,
			get: get,
			set: function (value) {
			setDescriptor(this, uid, {
				enumerable: false,
				configurable: true,
				writable: true,
				value: value
			});
			addInternalIfNeeded(this, uid, true);
			}
		};
		try {
			objectDefineProperty(ObjectProto, uid, descriptor);
		} catch (e) {
			ObjectProto[uid] = descriptor.value;
		}
		source[uid] = objectDefineProperty(
			Object(uid),
			'constructor',
			sourceConstructor
		);
		var description = gOPD(Symbol.prototype, 'description');
		if (description) {
			objectDefineProperty(
				source[uid],
				'description',
				description
			);
		}
		return freeze(source[uid]);
	};

	var symbolDescription = function (s) {
		var sym = thisSymbolValue(s);

		// 3. Return sym.[[Description]].
		if (supportsInferredNames) {
			var name = getInferredName(sym);
			if (name !== "") {
				return name.slice(1, -1); // name.slice('['.length, -']'.length);
			}
		}

		if (emptySymbolLookup[sym] !== undefined) {
			return emptySymbolLookup[sym];
		}

		var string = sym.toString();
		var randomStartIndex = string.lastIndexOf("0.");
		string = string.slice(10, randomStartIndex);

		if (string === "") {
			return undefined;
		}
		return string;
	};

	var Symbol = function Symbol() {
		var description = arguments[0];
		if (this instanceof Symbol) {
			throw new TypeError('Symbol is not a constructor');
		}

		var uid = prefix.concat(description || '', random, ++id);

		if (description !== undefined && (description === null || isNaN(description) || String(description) === "")) {
			emptySymbolLookup[uid] = String(description);
		}

		var that = setAndGetSymbol(uid);

		if (!supportsGetters) {
			Object.defineProperty(that, "description", {
				configurable: true,
				enumerable: false,
				value: symbolDescription(that)
			});
		}

		return that;
	};

	var source = objectCreate(null);
	var sourceConstructor = {value: Symbol};
	var sourceMap = function (uid) {
		return source[uid];
		};
	var $defineProperty = function defineProperty(o, key, descriptor) {
		var uid = '' + key;
		if (onlySymbols(uid)) {
			setDescriptor(o, uid, descriptor.enumerable ?
				copyAsNonEnumerable(descriptor) : descriptor);
			addInternalIfNeeded(o, uid, !!descriptor.enumerable);
		} else {
			objectDefineProperty(o, key, descriptor);
		}
		return o;
	};

	var onlyInternalSymbols = function (obj) {
		return function (name) {
			return hOP.call(obj, internalSymbol) && hOP.call(obj[internalSymbol], '@@' + name);
		};
	};
	var $getOwnPropertySymbols = function getOwnPropertySymbols(o) {
		return gOPN(o).filter(o === ObjectProto ? onlyInternalSymbols(o) : onlySymbols).map(sourceMap);
		}
	;

	descriptor.value = $defineProperty;
	objectDefineProperty(Object, DP, descriptor);

	descriptor.value = $getOwnPropertySymbols;
	objectDefineProperty(Object, GOPS, descriptor);

	descriptor.value = function getOwnPropertyNames(o) {
		return gOPN(o).filter(onlyNonSymbols);
	};
	objectDefineProperty(Object, GOPN, descriptor);

	descriptor.value = function defineProperties(o, descriptors) {
		var symbols = $getOwnPropertySymbols(descriptors);
		if (symbols.length) {
		objectKeys(descriptors).concat(symbols).forEach(function (uid) {
			if (propertyIsEnumerable.call(descriptors, uid)) {
			$defineProperty(o, uid, descriptors[uid]);
			}
		});
		} else {
		$defineProperties(o, descriptors);
		}
		return o;
	};
	objectDefineProperty(Object, DPies, descriptor);

	descriptor.value = propertyIsEnumerable;
	objectDefineProperty(ObjectProto, PIE, descriptor);

	descriptor.value = Symbol;
	objectDefineProperty(global, 'Symbol', descriptor);

	// defining `Symbol.for(key)`
	descriptor.value = function (key) {
		var uid = prefix.concat(prefix, key, random);
		return uid in ObjectProto ? source[uid] : setAndGetSymbol(uid);
	};
	objectDefineProperty(Symbol, 'for', descriptor);

	// defining `Symbol.keyFor(symbol)`
	descriptor.value = function (symbol) {
		if (onlyNonSymbols(symbol))
		throw new TypeError(symbol + ' is not a symbol');
		return hOP.call(source, symbol) ?
		symbol.slice(prefixLength * 2, -random.length) :
		void 0
		;
	};
	objectDefineProperty(Symbol, 'keyFor', descriptor);

	descriptor.value = function getOwnPropertyDescriptor(o, key) {
		var descriptor = gOPD(o, key);
		if (descriptor && onlySymbols(key)) {
		descriptor.enumerable = propertyIsEnumerable.call(o, key);
		}
		return descriptor;
	};
	objectDefineProperty(Object, GOPD, descriptor);

	descriptor.value = function create(proto, descriptors) {
		return arguments.length === 1 || typeof descriptors === "undefined" ?
		objectCreate(proto) :
		createWithSymbols(proto, descriptors);
	};

	objectDefineProperty(Object, 'create', descriptor);

	var strictModeSupported = (function(){ 'use strict'; return this; }).call(null) === null;
	if (strictModeSupported) {
		descriptor.value = function () {
			var str = toString.call(this);
			return (str === '[object String]' && onlySymbols(this)) ? '[object Symbol]' : str;
		};
	} else {
		descriptor.value = function () {
			// https://github.com/Financial-Times/polyfill-library/issues/164#issuecomment-486965300
			// Polyfill.io this code is here for the situation where a browser does not
			// support strict mode and is executing `Object.prototype.toString.call(null)`.
			// This code ensures that we return the correct result in that situation however,
			// this code also introduces a bug where it will return the incorrect result for
			// `Object.prototype.toString.call(window)`. We can't have the correct result for
			// both `window` and `null`, so we have opted for `null` as we believe this is the more
			// common situation.
			if (this === window) {
				return '[object Null]';
			}

			var str = toString.call(this);
			return (str === '[object String]' && onlySymbols(this)) ? '[object Symbol]' : str;
		};
	}
	objectDefineProperty(ObjectProto, 'toString', descriptor);

	setDescriptor = function (o, key, descriptor) {
		var protoDescriptor = gOPD(ObjectProto, key);
		delete ObjectProto[key];
		objectDefineProperty(o, key, descriptor);
		if (o !== ObjectProto) {
			objectDefineProperty(ObjectProto, key, protoDescriptor);
		}
	};

	// The abstract operation thisSymbolValue(value) performs the following steps:
	function thisSymbolValue(value) {
		// 1. If Type(value) is Symbol, return value.
		if (Type(value) === "symbol") {
			return value;
		}
		// 2. If Type(value) is Object and value has a [[SymbolData]] internal slot, then
		// a. Let s be value.[[SymbolData]].
		// b. Assert: Type(s) is Symbol.
		// c. Return s.
		// 3. Throw a TypeError exception.
		throw TypeError(value + " is not a symbol");
	}

	// Symbol.prototype.description
	if (function () {
		// supports getters
		try {
			var a = {};
			Object.defineProperty(a, "t", {
				configurable: true,
				enumerable: false,
				get: function() {
					return true;
				},
				set: undefined
			});
			return !!a.t;
		} catch (e) {
			return false;
		}
	}()) {
		var getInferredName;
		try {
			// eslint-disable-next-line no-new-func
			getInferredName = Function("s", "var v = s.valueOf(); return { [v]() {} }[v].name;");
			// eslint-disable-next-line no-empty
		} catch (e) { }

		var inferred = function () { };
		var supportsInferredNames = getInferredName && inferred.name === "inferred" ? getInferredName : null;


		// 19.4.3.2 get Symbol.prototype.description
		Object.defineProperty(global.Symbol.prototype, "description", {
			configurable: true,
			enumerable: false,
			get: function () {
				// 1. Let s be the this value.
				var s = this;
				return symbolDescription(s);
			}
		});
	}

}(Object, 'getOwnPropertySymbols', self));

// Reflect.ownKeys
/* global CreateMethodProperty, Reflect, Type */
// 26.1.10 Reflect.ownKeys ( target )
CreateMethodProperty(Reflect, 'ownKeys', function ownKeys(target) {
	// 1. If Type(target) is not Object, throw a TypeError exception.
	if (Type(target) !== "object") {
		throw new TypeError(Object.prototype.toString.call(target) + ' is not an Object');
	}
	// polyfill-library - These steps are taken care of by Object.getOwnPropertyNames.
	// 2. Let keys be ? target.[[OwnPropertyKeys]]().
	// 3. Return CreateArrayFromList(keys).
	return Object.getOwnPropertyNames(target).concat(Object.getOwnPropertySymbols(target));
});

// Symbol.toStringTag
/* global Symbol */
Object.defineProperty(Symbol, 'toStringTag', {
	value: Symbol('toStringTag')
});

// Promise
/*
	Yaku v0.19.3
	(c) 2015 Yad Smood. http://ysmood.org
	License MIT
*/
/*
	Yaku v0.17.9
	(c) 2015 Yad Smood. http://ysmood.org
	License MIT
*/
(function () {
	'use strict';

	var $undefined
	, $null = null
	, isBrowser = typeof self === 'object'
	, root = self
	, nativePromise = root.Promise
	, process = root.process
	, console = root.console
	, isLongStackTrace = true
	, Arr = Array
	, Err = Error

	, $rejected = 1
	, $resolved = 2
	, $pending = 3

	, $Symbol = 'Symbol'
	, $iterator = 'iterator'
	, $species = 'species'
	, $speciesKey = $Symbol + '(' + $species + ')'
	, $return = 'return'

	, $unhandled = '_uh'
	, $promiseTrace = '_pt'
	, $settlerTrace = '_st'

	, $invalidThis = 'Invalid this'
	, $invalidArgument = 'Invalid argument'
	, $fromPrevious = '\nFrom previous '
	, $promiseCircularChain = 'Chaining cycle detected for promise'
	, $unhandledRejectionMsg = 'Uncaught (in promise)'
	, $rejectionHandled = 'rejectionHandled'
	, $unhandledRejection = 'unhandledRejection'

	, $tryCatchFn
	, $tryCatchThis
	, $tryErr = { e: $null }
	, $noop = function () {}
	, $cleanStackReg = /^.+\/node_modules\/yaku\/.+\n?/mg
	;

	/**
	* This class follows the [Promises/A+](https://promisesaplus.com) and
	* [ES6](http://people.mozilla.org/~jorendorff/es6-draft.html#sec-promise-objects) spec
	* with some extra helpers.
	* @param  {Function} executor Function object with two arguments resolve, reject.
	* The first argument fulfills the promise, the second argument rejects it.
	* We can call these functions, once our operation is completed.
	*/
	var Yaku = function (executor) {
	var self = this,
		err;

	// "this._s" is the internao state of: pending, resolved or rejected
	// "this._v" is the internal value

	if (!isObject(self) || self._s !== $undefined)
		throw genTypeError($invalidThis);

	self._s = $pending;

	if (isLongStackTrace) self[$promiseTrace] = genTraceInfo();

	if (executor !== $noop) {
		if (!isFunction(executor))
			throw genTypeError($invalidArgument);

		err = genTryCatcher(executor)(
			genSettler(self, $resolved),
			genSettler(self, $rejected)
		);

		if (err === $tryErr)
			settlePromise(self, $rejected, err.e);
	}
	};

	Yaku['default'] = Yaku;

	extend(Yaku.prototype, {
	/**
		* Appends fulfillment and rejection handlers to the promise,
		* and returns a new promise resolving to the return value of the called handler.
		* @param  {Function} onFulfilled Optional. Called when the Promise is resolved.
		* @param  {Function} onRejected  Optional. Called when the Promise is rejected.
		* @return {Yaku} It will return a new Yaku which will resolve or reject after
		* @example
		* the current Promise.
		* ```js
		* var Promise = require('yaku');
		* var p = Promise.resolve(10);
		*
		* p.then((v) => {
		*     console.log(v);
		* });
		* ```
		*/
	then: function (onFulfilled, onRejected) {
		if (this._s === undefined) throw genTypeError();

		return addHandler(
			this,
			newCapablePromise(Yaku.speciesConstructor(this, Yaku)),
			onFulfilled,
			onRejected
		);
	},

	/**
		* The `catch()` method returns a Promise and deals with rejected cases only.
		* It behaves the same as calling `Promise.prototype.then(undefined, onRejected)`.
		* @param  {Function} onRejected A Function called when the Promise is rejected.
		* This function has one argument, the rejection reason.
		* @return {Yaku} A Promise that deals with rejected cases only.
		* @example
		* ```js
		* var Promise = require('yaku');
		* var p = Promise.reject(new Error("ERR"));
		*
		* p['catch']((v) => {
		*     console.log(v);
		* });
		* ```
		*/
	'catch': function (onRejected) {
		return this.then($undefined, onRejected);
	},

	/**
		* Register a callback to be invoked when a promise is settled (either fulfilled or rejected).
		* Similar with the try-catch-finally, it's often used for cleanup.
		* @param  {Function} onFinally A Function called when the Promise is settled.
		* It will not receive any argument.
		* @return {Yaku} A Promise that will reject if onFinally throws an error or returns a rejected promise.
		* Else it will resolve previous promise's final state (either fulfilled or rejected).
		* @example
		* ```js
		* var Promise = require('yaku');
		* var p = Math.random() > 0.5 ? Promise.resolve() : Promise.reject();
		* p.finally(() => {
		*     console.log('finally');
		* });
		* ```
		*/
	'finally': function (onFinally) {
		return this.then(function (val) {
			return Yaku.resolve(onFinally()).then(function () {
				return val;
			});
		}, function (err) {
			return Yaku.resolve(onFinally()).then(function () {
				throw err;
			});
		});
	},

	// The number of current promises that attach to this Yaku instance.
	_c: 0,

	// The parent Yaku.
	_p: $null
	});

	/**
	* The `Promise.resolve(value)` method returns a Promise object that is resolved with the given value.
	* If the value is a thenable (i.e. has a then method), the returned promise will "follow" that thenable,
	* adopting its eventual state; otherwise the returned promise will be fulfilled with the value.
	* @param  {Any} value Argument to be resolved by this Promise.
	* Can also be a Promise or a thenable to resolve.
	* @return {Yaku}
	* @example
	* ```js
	* var Promise = require('yaku');
	* var p = Promise.resolve(10);
	* ```
	*/
	Yaku.resolve = function (val) {
	return isYaku(val) ? val : settleWithX(newCapablePromise(this), val);
	};

	/**
	* The `Promise.reject(reason)` method returns a Promise object that is rejected with the given reason.
	* @param  {Any} reason Reason why this Promise rejected.
	* @return {Yaku}
	* @example
	* ```js
	* var Promise = require('yaku');
	* var p = Promise.reject(new Error("ERR"));
	* ```
	*/
	Yaku.reject = function (reason) {
	return settlePromise(newCapablePromise(this), $rejected, reason);
	};

	/**
	* The `Promise.race(iterable)` method returns a promise that resolves or rejects
	* as soon as one of the promises in the iterable resolves or rejects,
	* with the value or reason from that promise.
	* @param  {iterable} iterable An iterable object, such as an Array.
	* @return {Yaku} The race function returns a Promise that is settled
	* the same way as the first passed promise to settle.
	* It resolves or rejects, whichever happens first.
	* @example
	* ```js
	* var Promise = require('yaku');
	* Promise.race([
	*     123,
	*     Promise.resolve(0)
	* ])
	* .then((value) => {
	*     console.log(value); // => 123
	* });
	* ```
	*/
	Yaku.race = function (iterable) {
	var self = this
		, p = newCapablePromise(self)

		, resolve = function (val) {
			settlePromise(p, $resolved, val);
		}

		, reject = function (val) {
			settlePromise(p, $rejected, val);
		}

		, ret = genTryCatcher(each)(iterable, function (v) {
			self.resolve(v).then(resolve, reject);
		});

	if (ret === $tryErr) return self.reject(ret.e);

	return p;
	};

	/**
	* The `Promise.all(iterable)` method returns a promise that resolves when
	* all of the promises in the iterable argument have resolved.
	*
	* The result is passed as an array of values from all the promises.
	* If something passed in the iterable array is not a promise,
	* it's converted to one by Promise.resolve. If any of the passed in promises rejects,
	* the all Promise immediately rejects with the value of the promise that rejected,
	* discarding all the other promises whether or not they have resolved.
	* @param  {iterable} iterable An iterable object, such as an Array.
	* @return {Yaku}
	* @example
	* ```js
	* var Promise = require('yaku');
	* Promise.all([
	*     123,
	*     Promise.resolve(0)
	* ])
	* .then((values) => {
	*     console.log(values); // => [123, 0]
	* });
	* ```
	* @example
	* Use with iterable.
	* ```js
	* var Promise = require('yaku');
	* Promise.all((function * () {
	*     yield 10;
	*     yield new Promise(function (r) { setTimeout(r, 1000, "OK") });
	* })())
	* .then((values) => {
	*     console.log(values); // => [123, 0]
	* });
	* ```
	*/
	Yaku.all = function (iterable) {
	var self = this
		, p1 = newCapablePromise(self)
		, res = []
		, ret
	;

	function reject (reason) {
		settlePromise(p1, $rejected, reason);
	}

	ret = genTryCatcher(each)(iterable, function (item, i) {
		self.resolve(item).then(function (value) {
			res[i] = value;
			if (!--ret) settlePromise(p1, $resolved, res);
		}, reject);
	});

	if (ret === $tryErr) return self.reject(ret.e);

	if (!ret) settlePromise(p1, $resolved, []);

	return p1;
	};

	/**
	* The ES6 Symbol object that Yaku should use, by default it will use the
	* global one.
	* @type {Object}
	* @example
	* ```js
	* var core = require("core-js/library");
	* var Promise = require("yaku");
	* Promise.Symbol = core.Symbol;
	* ```
	*/
	Yaku.Symbol = root[$Symbol] || {};

	// To support browsers that don't support `Object.defineProperty`.
	genTryCatcher(function () {
	Object.defineProperty(Yaku, getSpecies(), {
		get: function () { return this; }
	});
	})();

	/**
	* Use this api to custom the species behavior.
	* https://tc39.github.io/ecma262/#sec-speciesconstructor
	* @param {Any} O The current this object.
	* @param {Function} defaultConstructor
	*/
	Yaku.speciesConstructor = function (O, D) {
	var C = O.constructor;

	return C ? (C[getSpecies()] || D) : D;
	};

	/**
	* Catch all possibly unhandled rejections. If you want to use specific
	* format to display the error stack, overwrite it.
	* If it is set, auto `console.error` unhandled rejection will be disabled.
	* @param {Any} reason The rejection reason.
	* @param {Yaku} p The promise that was rejected.
	* @example
	* ```js
	* var Promise = require('yaku');
	* Promise.unhandledRejection = (reason) => {
	*     console.error(reason);
	* };
	*
	* // The console will log an unhandled rejection error message.
	* Promise.reject('my reason');
	*
	* // The below won't log the unhandled rejection error message.
	* Promise.reject('v')["catch"](() => {});
	* ```
	*/
	Yaku.unhandledRejection = function (reason, p) {
	console && console.error(
		$unhandledRejectionMsg,
		isLongStackTrace ? p.longStack : genStackInfo(reason, p)
	);
	};

	/**
	* Emitted whenever a Promise was rejected and an error handler was
	* attached to it (for example with `["catch"]()`) later than after an event loop turn.
	* @param {Any} reason The rejection reason.
	* @param {Yaku} p The promise that was rejected.
	*/
	Yaku.rejectionHandled = $noop;

	/**
	* It is used to enable the long stack trace.
	* Once it is enabled, it can't be reverted.
	* While it is very helpful in development and testing environments,
	* it is not recommended to use it in production. It will slow down
	* application and eat up memory.
	* It will add an extra property `longStack` to the Error object.
	* @example
	* ```js
	* var Promise = require('yaku');
	* Promise.enableLongStackTrace();
	* Promise.reject(new Error("err"))["catch"]((err) => {
	*     console.log(err.longStack);
	* });
	* ```
	*/
	Yaku.enableLongStackTrace = function () {
	isLongStackTrace = true;
	};

	/**
	* Only Node has `process.nextTick` function. For browser there are
	* so many ways to polyfill it. Yaku won't do it for you, instead you
	* can choose what you prefer. For example, this project
	* [next-tick](https://github.com/medikoo/next-tick).
	* By default, Yaku will use `process.nextTick` on Node, `setTimeout` on browser.
	* @type {Function}
	* @example
	* ```js
	* var Promise = require('yaku');
	* Promise.nextTick = require('next-tick');
	* ```
	* @example
	* You can even use sync resolution if you really know what you are doing.
	* ```js
	* var Promise = require('yaku');
	* Promise.nextTick = fn => fn();
	* ```
	*/
	Yaku.nextTick = isBrowser ?
	function (fn) {
		nativePromise ?
			new nativePromise(function (resolve) { resolve(); }).then(fn) :
			setTimeout(fn);
	} :
	process.nextTick;

	// ********************** Private **********************

	Yaku._s = 1;

	/**
	* All static variable name will begin with `$`. Such as `$rejected`.
	* @private
	*/

	// ******************************* Utils ********************************

	function getSpecies () {
	return Yaku[$Symbol][$species] || $speciesKey;
	}

	function extend (src, target) {
	for (var k in target) {
		src[k] = target[k];
	}
	}

	function isObject (obj) {
	return obj && typeof obj === 'object';
	}

	function isFunction (obj) {
	return typeof obj === 'function';
	}

	function isInstanceOf (a, b) {
	return a instanceof b;
	}

	function isError (obj) {
	return isInstanceOf(obj, Err);
	}

	function ensureType (obj, fn, msg) {
	if (!fn(obj)) throw genTypeError(msg);
	}

	/**
	* Wrap a function into a try-catch.
	* @private
	* @return {Any | $tryErr}
	*/
	function tryCatcher () {
	try {
		return $tryCatchFn.apply($tryCatchThis, arguments);
	} catch (e) {
		$tryErr.e = e;
		return $tryErr;
	}
	}

	/**
	* Generate a try-catch wrapped function.
	* @private
	* @param  {Function} fn
	* @return {Function}
	*/
	function genTryCatcher (fn, self) {
	$tryCatchFn = fn;
	$tryCatchThis = self;
	return tryCatcher;
	}

	/**
	* Generate a scheduler.
	* @private
	* @param  {Integer}  initQueueSize
	* @param  {Function} fn `(Yaku, Value) ->` The schedule handler.
	* @return {Function} `(Yaku, Value) ->` The scheduler.
	*/
	function genScheduler (initQueueSize, fn) {
	/**
		* All async promise will be scheduled in
		* here, so that they can be execute on the next tick.
		* @private
		*/
	var fnQueue = Arr(initQueueSize)
		, fnQueueLen = 0;

	/**
		* Run all queued functions.
		* @private
		*/
	function flush () {
		var i = 0;
		while (i < fnQueueLen) {
			fn(fnQueue[i], fnQueue[i + 1]);
			fnQueue[i++] = $undefined;
			fnQueue[i++] = $undefined;
		}

		fnQueueLen = 0;
		if (fnQueue.length > initQueueSize) fnQueue.length = initQueueSize;
	}

	return function (v, arg) {
		fnQueue[fnQueueLen++] = v;
		fnQueue[fnQueueLen++] = arg;

		if (fnQueueLen === 2) Yaku.nextTick(flush);
	};
	}

	/**
	* Generate a iterator
	* @param  {Any} obj
	* @private
	* @return {Object || TypeError}
	*/
	function each (iterable, fn) {
	var len
		, i = 0
		, iter
		, item
		, ret
	;

	if (!iterable) throw genTypeError($invalidArgument);

	var gen = iterable[Yaku[$Symbol][$iterator]];
	if (isFunction(gen))
		iter = gen.call(iterable);
	else if (isFunction(iterable.next)) {
		iter = iterable;
	}
	else if (isInstanceOf(iterable, Arr)) {
		len = iterable.length;
		while (i < len) {
			fn(iterable[i], i++);
		}
		return i;
	} else
		throw genTypeError($invalidArgument);

	while (!(item = iter.next()).done) {
		ret = genTryCatcher(fn)(item.value, i++);
		if (ret === $tryErr) {
			isFunction(iter[$return]) && iter[$return]();
			throw ret.e;
		}
	}

	return i;
	}

	/**
	* Generate type error object.
	* @private
	* @param  {String} msg
	* @return {TypeError}
	*/
	function genTypeError (msg) {
	return new TypeError(msg);
	}

	function genTraceInfo (noTitle) {
	return (noTitle ? '' : $fromPrevious) + new Err().stack;
	}


	// *************************** Promise Helpers ****************************

	/**
	* Resolve the value returned by onFulfilled or onRejected.
	* @private
	* @param {Yaku} p1
	* @param {Yaku} p2
	*/
	var scheduleHandler = genScheduler(999, function (p1, p2) {
	var x, handler;

	// 2.2.2
	// 2.2.3
	handler = p1._s !== $rejected ? p2._onFulfilled : p2._onRejected;

	// 2.2.7.3
	// 2.2.7.4
	if (handler === $undefined) {
		settlePromise(p2, p1._s, p1._v);
		return;
	}

	// 2.2.7.1
	x = genTryCatcher(callHanler)(handler, p1._v);
	if (x === $tryErr) {
		// 2.2.7.2
		settlePromise(p2, $rejected, x.e);
		return;
	}

	settleWithX(p2, x);
	});

	var scheduleUnhandledRejection = genScheduler(9, function (p) {
	if (!hashOnRejected(p)) {
		p[$unhandled] = 1;
		emitEvent($unhandledRejection, p);
	}
	});

	function emitEvent (name, p) {
	var browserEventName = 'on' + name.toLowerCase()
		, browserHandler = root[browserEventName];

	if (process && process.listeners(name).length)
		name === $unhandledRejection ?
			process.emit(name, p._v, p) : process.emit(name, p);
	else if (browserHandler)
		browserHandler({ reason: p._v, promise: p });
	else
		Yaku[name](p._v, p);
	}

	function isYaku (val) { return val && val._s; }

	function newCapablePromise (Constructor) {
	if (isYaku(Constructor)) return new Constructor($noop);

	var p, r, j;
	p = new Constructor(function (resolve, reject) {
		if (p) throw genTypeError();

		r = resolve;
		j = reject;
	});

	ensureType(r, isFunction);
	ensureType(j, isFunction);

	return p;
	}

	/**
	* It will produce a settlePromise function to user.
	* Such as the resolve and reject in this `new Yaku (resolve, reject) ->`.
	* @private
	* @param  {Yaku} self
	* @param  {Integer} state The value is one of `$pending`, `$resolved` or `$rejected`.
	* @return {Function} `(value) -> undefined` A resolve or reject function.
	*/
	function genSettler (self, state) {
	var isCalled = false;
	return function (value) {
		if (isCalled) return;
		isCalled = true;

		if (isLongStackTrace)
			self[$settlerTrace] = genTraceInfo(true);

		if (state === $resolved)
			settleWithX(self, value);
		else
			settlePromise(self, state, value);
	};
	}

	/**
	* Link the promise1 to the promise2.
	* @private
	* @param {Yaku} p1
	* @param {Yaku} p2
	* @param {Function} onFulfilled
	* @param {Function} onRejected
	*/
	function addHandler (p1, p2, onFulfilled, onRejected) {
	// 2.2.1
	if (isFunction(onFulfilled))
		p2._onFulfilled = onFulfilled;
	if (isFunction(onRejected)) {
		if (p1[$unhandled]) emitEvent($rejectionHandled, p1);

		p2._onRejected = onRejected;
	}

	if (isLongStackTrace) p2._p = p1;
	p1[p1._c++] = p2;

	// 2.2.6
	if (p1._s !== $pending)
		scheduleHandler(p1, p2);

	// 2.2.7
	return p2;
	}

	// iterate tree
	function hashOnRejected (node) {
	// A node shouldn't be checked twice.
	if (node._umark)
		return true;
	else
		node._umark = true;

	var i = 0
		, len = node._c
		, child;

	while (i < len) {
		child = node[i++];
		if (child._onRejected || hashOnRejected(child)) return true;
	}
	}

	function genStackInfo (reason, p) {
	var stackInfo = [];

	function push (trace) {
		return stackInfo.push(trace.replace(/^\s+|\s+$/g, ''));
	}

	if (isLongStackTrace) {
		if (p[$settlerTrace])
			push(p[$settlerTrace]);

		// Hope you guys could understand how the back trace works.
		// We only have to iterate through the tree from the bottom to root.
		(function iter (node) {
			if (node && $promiseTrace in node) {
				iter(node._next);
				push(node[$promiseTrace] + '');
				iter(node._p);
			}
		})(p);
	}

	return (reason && reason.stack ? reason.stack : reason) +
		('\n' + stackInfo.join('\n')).replace($cleanStackReg, '');
	}

	function callHanler (handler, value) {
	// 2.2.5
	return handler(value);
	}

	/**
	* Resolve or reject a promise.
	* @private
	* @param  {Yaku} p
	* @param  {Integer} state
	* @param  {Any} value
	*/
	function settlePromise (p, state, value) {
	var i = 0
		, len = p._c;

	// 2.1.2
	// 2.1.3
	if (p._s === $pending) {
		// 2.1.1.1
		p._s = state;
		p._v = value;

		if (state === $rejected) {
			if (isLongStackTrace && isError(value)) {
				value.longStack = genStackInfo(value, p);
			}

			scheduleUnhandledRejection(p);
		}

		// 2.2.4
		while (i < len) {
			scheduleHandler(p, p[i++]);
		}
	}

	return p;
	}

	/**
	* Resolve or reject promise with value x. The x can also be a thenable.
	* @private
	* @param {Yaku} p
	* @param {Any | Thenable} x A normal value or a thenable.
	*/
	function settleWithX (p, x) {
	// 2.3.1
	if (x === p && x) {
		settlePromise(p, $rejected, genTypeError($promiseCircularChain));
		return p;
	}

	// 2.3.2
	// 2.3.3
	if (x !== $null && (isFunction(x) || isObject(x))) {
		// 2.3.2.1
		var xthen = genTryCatcher(getThen)(x);

		if (xthen === $tryErr) {
			// 2.3.3.2
			settlePromise(p, $rejected, xthen.e);
			return p;
		}

		if (isFunction(xthen)) {
			if (isLongStackTrace && isYaku(x))
				p._next = x;

			// Fix https://bugs.chromium.org/p/v8/issues/detail?id=4162
			if (isYaku(x))
				settleXthen(p, x, xthen);
			else
				Yaku.nextTick(function () {
					settleXthen(p, x, xthen);
				});
		} else
			// 2.3.3.4
			settlePromise(p, $resolved, x);
	} else
		// 2.3.4
		settlePromise(p, $resolved, x);

	return p;
	}

	/**
	* Try to get a promise's then method.
	* @private
	* @param  {Thenable} x
	* @return {Function}
	*/
	function getThen (x) { return x.then; }

	/**
	* Resolve then with its promise.
	* @private
	* @param  {Yaku} p
	* @param  {Thenable} x
	* @param  {Function} xthen
	*/
	function settleXthen (p, x, xthen) {
	// 2.3.3.3
	var err = genTryCatcher(xthen, x)(function (y) {
		// 2.3.3.3.3
		// 2.3.3.3.1
		x && (x = $null, settleWithX(p, y));
	}, function (r) {
		// 2.3.3.3.3
		// 2.3.3.3.2
		x && (x = $null, settlePromise(p, $rejected, r));
	});

	// 2.3.3.3.4.1
	if (err === $tryErr && x) {
		// 2.3.3.3.4.2
		settlePromise(p, $rejected, err.e);
		x = $null;
	}
	}

	root.Promise = Yaku;
})();
})
('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});
