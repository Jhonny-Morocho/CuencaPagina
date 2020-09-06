@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../ivan1986/dev-container/bin/container
php "%BIN_TARGET%" %*
