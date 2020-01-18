<div class="panel">
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

			<!-- Name Start -->
			<div class="col-md-12">
			 <div class="form-group">
			  <label for="name" class="control-label"> Nombre o descripcion del rol </label>
			    <input type="text" class="form-control" id="name" name="name" value="{{{ isset($data->name ) ? $data->name  : old('name') }}}">
					<input type="hidden" class="form-control" id="status" name="status" value="1">
			    <div class="label label-danger">{{ $errors->first("name") }}</div>
			 </div>
			</div>
			<!-- Name End -->

		</div>

	</div>
</div>

<div class="panel">
	<div class="panel-wrapper collapse in" aria-expanded="true">
		<div class="panel-body">

			<div class="row">
				<?php foreach($modulos as $modulo) { ?>

					<div class="col-md-4" style="margin-bottom:20px">
							<div class="checkbox checkbox-info">
									<input name="modulo[<?php echo $modulo['id']; ?>][modulo]" id="modulo_<?php echo $modulo['id']; ?>"
												 value="<?php echo $modulo['id']; ?>" type="checkbox" onclick="$('.item-<?php echo strtolower(str_replace(' ','',$modulo['id'])); ?>').prop('checked', this.checked);"
												 <?php if(in_array($modulo['id'],$seleccionados)) { echo 'checked'; } ?>>
									<label for="modulo_<?php echo $modulo['id']; ?>">
										<li class="fa <?php echo $modulo['icon_font']; ?> fa-lg"></li> <?php echo $modulo['nombre']; ?>
									</label>
							</div>

							<?php if($modulo['childs']) { ?>

								<?php foreach($modulo['childs'] as $childs) { ?>

									<div class="col-md-12" style="margin-bottom:5px; margin-left:20px">

										<div class="checkbox checkbox-info">

											<input class="item-<?php echo strtolower(str_replace(' ','',$modulo['id'])); ?>" name="modulo[<?php echo $childs['id']; ?>][modulo]" id="modulo_<?php echo $childs['id']; ?>"
														 value="<?php echo $childs['id']; ?>" type="checkbox"
														 <?php if(in_array($childs['id'],$seleccionados)) { echo 'checked'; } ?>>
											<label for="modulo_<?php echo $childs['id']; ?>">
												<?php echo $childs['nombre']; ?>
											</label>

										</div>

									</div>

								<?php } ?>

							<?php } ?>

						</div>

				<?php } ?>
			</div>

		</div>
		<div class="panel-footer text-right">

		</div>
	</div>
</div>
