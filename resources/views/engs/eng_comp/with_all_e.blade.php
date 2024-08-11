<tbody id="with_all_e" style="display : none">
			@if(($ville_fr =="Ouled Djellal" || $ville_fr =="ouled djellal" || $ville_fr =="Biskra" || $ville_fr =="Touggourt"
			|| $ville_fr =="Ouled djellal") && $insc == "true" )
				@foreach($titres2 as $titre)
					@if($titre->sums["montant_2"] != 0 || $titre->sums["montant"] != 0 || $titre->sums["montant_1"] != 0)
					<tr style='font-weight : 900;'>	
						<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
						
						@if($ville_fr !="Ouled Djellal")
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
						<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
						@endif
					</tr>
					@endif
					@foreach($titre->rebriques as $reb)
					@if($reb->id_titre == 127)

					@else
						@if($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0)
						<tr>	
							<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
								<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
							@if($ville_fr !="Ouled Djellal")
							<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
							@else

								<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>
		
							@endif
						</tr>
						@endif
					@endif
					
					@endforeach
				@endforeach
			@else
				@foreach($titres2 as $titre)
					@if($titre->sums["montant_2"] != 0 || $titre->sums["montant"] != 0 || $titre->sums["montant_1"] != 0)
					<tr style='font-weight : 900;'>	
						<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
						@if($ville_fr !="Ouled Djellal")
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
							@if($titre->id_titre == 128)
							<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
							@else
							<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
							@endif
						@endif
					</tr>
					@endif
					@foreach($titre->rebriques as $reb)
					@if($reb->id_titre == 127)

					@else
						@if($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0)
						<tr>	
							<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
							@if($ville_fr !="Ouled Djellal")
							<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
							@else
								<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>

							@endif
						</tr>
					@endif
					@endif
					
					@endforeach
				@endforeach
			@endif
			@if($ville_fr =="Biskra" || $ville_fr =="Touggourt")
			@if($insc =="true")
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@else
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant_1, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@endif
			@endif
			</tbody>