import node from '@rollup/plugin-node-resolve';
import cjs from '@rollup/plugin-commonjs'; // Convert CommonJS module into ES module
import css from 'rollup-plugin-import-css'; // Collect css
import json from '@rollup/plugin-json';
import terser from '@rollup/plugin-terser'; // Rollup plugin to minify generated es bundle
import * as fs from 'fs';

const pkg = JSON.parse(fs.readFileSync('./package.json', 'utf-8'));
const banner = fs.readFileSync('./build/banner.js', 'utf-8')
  .replace('{name}', pkg.name)
  .replace('{description}', pkg.description)
  .replace('{homepage}', pkg.homepage)
  .replace('{version}', pkg.version)
  .replace('{time}', new Date().toLocaleString())
  .replace('*/', '*/\n');

export default [{
  // Full myol / debug library
  input: 'build/index.js',
  plugins: [
    node(),
    cjs(),
    css({
      output: 'myol.css',
    }),
    json(),
  ],
  output: [{
    name: 'myol',
    banner,
    file: 'dist/myol-debug.js',
    format: 'iife',
  }],
}, {
  // Full myol / compressed library
  input: 'build/index.js',
  plugins: [
    node(),
    cjs(),
    css({
      minify: true,
      output: 'myol-min.css',
    }),
    json(),
    terser(),
  ],
  output: [{
    name: 'myol',
    banner,
    file: 'dist/myol.js',
    format: 'umd',
    sourcemap: true,
  }],
}];