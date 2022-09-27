<div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" wire:model="m_intakeId">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="name">First name</label>
                            <input type="text" class="form-control"  wire:model.defer="m_first_name" id="edit-firstname" aria-describedby="helpId" required>
                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="name">Last name</label>
                            <input type="text" class="form-control" wire:model.defer="m_last_name" id="edit-lastname" aria-describedby="helpId" required>
                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="telephone">Telephone</label>
                            <input type="tel" class="form-control"  wire:model.defer="m_telephone" id="edit-telephone" aria-describedby="helpId" required>
                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="email">Email</label>
                            <input type="email" class="form-control" wire:model.defer="m_email" id="edit-email" aria-describedby="helpId" required>
                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="internet_provider">Internet provider</label>
                            <input type="text" class="form-control"  wire:model.defer="m_internet_provider" id="edit-internet_provider" aria-describedby="helpId">
                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="setup_location">Setup location</label>
                            <input type="text" class="form-control"  wire:model.defer="m_setup_location" id="edit-setup_location" aria-describedby="helpId">

                        </div>

                        <div class="col form-group">
                            <label class="font-weight-bold" for="">Ethernet length</label>
                            <select id="edit-ethernt_cable" wire:model.defer="m_ethernet_cable" class="form-control">
                                <option value="None">None</option>
                                <option value="5 Meters">5 Meters</option>
                                <option value="10 Meters">10 Meters</option>
                                <option value="15 Meters">15 Meters</option>
                                <option value="20 Meters">20 Meters</option>
                                <option value="Massive">Massive</option>
                            </select>
                        </div>
                        <input type="hidden" name="batch_no" value="">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="">Equipment collection date\time</label>
                            <input type="datetime-local" class="form-control" wire:model.defer="m_equipment_collection" id="edit-equipment_collection" aria-describedby="helpId">

                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="">Notes</label>
                            <textarea  class="h-50 form-control w-100" wire:model.defer="m_notes" id="edit-notes" aria-describedby="helpId"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="save" type="submit" data-dismiss="modal" class="btn btn-teal">Save</button>
                        <button data-dismiss="modal" class="btn btn-secondary">Close</button>
                    </div>

        </div>
    </div>
</div>
