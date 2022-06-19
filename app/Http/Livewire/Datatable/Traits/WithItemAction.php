<?php
namespace App\Http\Livewire\Datatable\Traits;

use App\Http\Livewire\Datatable\TableDefinition\Column;
use App\Http\Livewire\Datatable\TableDefinition\ItemAction;
use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

trait WithItemAction {

    /**
     * @return array
     */
    public function itemActions(): array
    {
        return [];
    }

    public function defaultItemActions(): array
    {
        return [
            $this->getViewItemAction(),
            $this->getEditItemAction(),
            $this->getCopyToClipboardItemAction(),
            $this->getExportItemAction(),
            $this->getDeleteItemAction()
        ];
    }

    public function getViewItemAction() : ItemAction
    {
        return ItemAction::make()
            ->text('View')
            ->method('view_row')
            ->authorize(true);
    }

    public function getEditItemAction() : ItemAction
    {
        return ItemAction::make()
            ->text('Edit')
            ->method('edit_row')
            ->authorize(true);
    }

    public function getCopyToClipboardItemAction() : ItemAction
    {
        return  ItemAction::make()
            ->text('Copy to clipboard')
            ->method('copy_to_clipboard_row')
            ->icon('clipboard')
            ->authorize(true);
    }

    public function getExportItemAction() : ItemAction
    {
        return ItemAction::make()
            ->text('Export')
            ->method('export_row')
            ->icon('export')
            ->authorize(true);
    }

    public function getDeleteItemAction() : ItemAction
    {
        return ItemAction::make()
            ->text('Delete')
            ->method('delete_row')
            ->icon('trash')
            ->class('text-red-600')
            ->authorize(true);
    }

    #[Pure]
    public function getItemAction(int $index): ItemAction
    {
        return $this->itemActions()[$index];
    }

    #[Pure]
    public function allowItemActionIf(ItemAction $itemAction, $row): bool
    {
        return true;
    }

    public function getRowData($row, string $column) : string
    {
        return $row->{$column};
    }

    public function isUnauthorizedItemAction(string $methodName, $rowId) : bool
    {
        $itemAction = collect($this->itemActions())->first(fn($itemAction, $index) => $this->getItemAction($index)->getMethod() === $methodName);
        $row = $this->getRowsQuery()->where($this->primaryKey, '=', $rowId)->first();

        if($itemAction === null || $row === null || !$itemAction->isAllowed() || !$this->allowItemActionIf($itemAction, $row)) return true;

        return false;
    }

    /**
     * @param $rowId
     * @return void
     */
    #[NoReturn]
    public function view_row($rowId): void
    {
        abort_if($this->isUnauthorizedItemAction('view_row', $rowId),403, 'Cannot View Row');

        dd($rowId);
    }

    #[NoReturn]
    public function edit_row($rowId): void
    {
        abort_if($this->isUnauthorizedItemAction('edit_row', $rowId),403, 'Cannot Edit Row');

        dd($rowId);
    }

    #[NoReturn]
    public function copy_to_clipboard_row($rowId): void
    {
        abort_if($this->isUnauthorizedItemAction('copy_to_clipboard_row', $rowId),403, 'Cannot Copy To Clipboard Row');
        dd($rowId);
    }

    #[NoReturn]
    public function export_row($rowId): void
    {
        abort_if($this->isUnauthorizedItemAction('export_row', $rowId),403, 'Cannot Export Row');
        dd($rowId);
    }

    #[NoReturn]
    public function delete_row($rowId): void
    {
        abort_if($this->isUnauthorizedItemAction('delete_row', $rowId),403, 'Cannot Delete Row');
        dd($rowId);
    }
}
