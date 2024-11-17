<?php

class DashboardController
{
    public function getDashboardData()
    {
        $productoModel = new ProductoModel();
        $ventaModel = new VentaModel();
        $proveedorModel = new ProveedorModel();

        $productosCount = $productoModel->count();
        $ventasCount = $ventaModel->count();
        $proveedoresCount = $proveedorModel->count();

        return [
            'productos' => $productosCount,
            'ventas' => $ventasCount,
            'proveedores' => $proveedoresCount
        ];
    }
}
