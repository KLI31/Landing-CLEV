@echo off
echo ================================
echo   CLEV Landing - Limpiar Cache
echo ================================
echo.

if exist "cache\enrollments.json" (
    del "cache\enrollments.json"
    echo ✓ Cache de enrollments eliminado
) else (
    echo ⚠ No existe cache de enrollments
)

echo.
echo Cache limpiado completamente
echo.
pause
