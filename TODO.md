# TODO: Add Hold Order Feature

## Migration
- [ ] Edit migration file to add 'status' column to sales table (enum: 'completed', 'held', default 'completed')

## Models
- [ ] Update Sale.php: add 'status' to fillable, add scopeHeld() and scopeCompleted()

## Services
- [ ] Update SaleService.php: modify createSale() to accept $status parameter, only deduct stock if status == 'completed'

## Controllers
- [ ] Update SaleController.php: add hold() method to create held sales

## Routes
- [ ] Update routes/web.php: add POST route for /pos/hold

## Views
- [ ] Update resources/views/pos/index.blade.php: make hold button functional (AJAX to /pos/hold), add section to list held orders with resume buttons, add JS for resuming (load items into cart)

## Additional
- [ ] Update SaleController show() and receipt() to restrict held sales (only allow completed)
- [ ] Run migration
- [ ] Test holding orders
- [ ] Test resuming held orders
- [ ] Ensure completed sales still work
