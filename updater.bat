@echo OFF
::--------------------------------------------------------
::-- Relizar PING y guardar el resultado
::--------------------------------------------------------
ping -n 3 www.google.com>reporte.txt

::--------------------------------------------------------
::-- Leer resultado y guardar en la base de datos
::--------------------------------------------------------
call:read_file

set "sstr=o ="
call:find_pos
set /a cut1=%pos%+3
set "sstr=, M ximo"
call:find_pos
set /a cut2=%pos%-%cut1%-3
call set minimo=%%str1:~%cut1%,%cut2%%%

set "sstr=ximo = "
call:find_pos
set /a cut1=%pos%+6
set "sstr=, Media"
call:find_pos
set /a cut2=%pos%-%cut1%-3
call set maximo=%%str1:~%cut1%,%cut2%%%

set "sstr=Media = "
call:find_pos
set /a cut1=%pos%+7
set "sstr=, Media"
call:find_pos
set /a cut2=-2
call set promedio=%%str1:~%cut1%,%cut2%%%

C:\xampp\mysql\bin\mysql.exe -e "USE monitor; INSERT INTO latencia (hora,retardo) VALUES ('%time%',%promedio%);" -u root
::--------------------------------------------------------
::-- Function section starts below here
::--------------------------------------------------------
:find_pos
@echo OFF
Set "pos=0"
SET stemp=%str1%&SET pos=0
:loop
SET /a pos+=1
echo %stemp%|FINDSTR /b /c:"%sstr%" >NUL
IF ERRORLEVEL 1 (
SET stemp=%stemp:~1%
IF DEFINED stemp GOTO loop
SET pos=0
)
GOTO:EOF

:read_file
@ECHO OFF
set "xprvar="
for /F "skip=10 delims=" %%i in (reporte.txt) do if not defined xprvar set "xprvar=%%i"
set "str1=%xprvar%"
GOTO:EOF