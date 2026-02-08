const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

const repoRoot = path.join(__dirname, '..');
const versionPath = path.join(repoRoot, 'VERSION');
const packagePath = path.join(repoRoot, 'package.json');
const readmePath = path.join(repoRoot, 'README.md');
const publicVersionPath = path.join(repoRoot, 'public', 'version.txt');

const rawVersion = fs.readFileSync(versionPath, 'utf8').trim();
const cleanVersion = rawVersion.replace(/^V/i, '');

let gitSha = 'dev';
try {
  gitSha = execSync('git rev-parse --short HEAD', { cwd: repoRoot, stdio: ['ignore', 'pipe', 'ignore'] })
    .toString()
    .trim();
} catch (error) {
  // Keep fallback 'dev' when git is unavailable.
}

const publicVersion = `${rawVersion}-${gitSha}`;
fs.writeFileSync(publicVersionPath, `${publicVersion}\n`, 'utf8');

const pkg = JSON.parse(fs.readFileSync(packagePath, 'utf8'));
if (pkg.version !== cleanVersion) {
  pkg.version = cleanVersion;
  fs.writeFileSync(packagePath, `${JSON.stringify(pkg, null, 2)}\n`, 'utf8');
}

const readme = fs.readFileSync(readmePath, 'utf8');
const updatedReadme = readme.replace(/(https:\/\/img\.shields\.io\/badge\/version-)([^-]+)(-blue)/, `$1${cleanVersion}$3`);
if (updatedReadme !== readme) {
  fs.writeFileSync(readmePath, updatedReadme, 'utf8');
}

console.log(`Updated version files to ${publicVersion}`);
